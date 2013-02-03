<?php

class FbPage{

	private $url_page;
	private $fb_page_albums_contents;
	private $fb_page_albums_photos_like;
	private $fbUsersThatLikeAlbums ;
	private $fbUsersImg50x50SrcThatLikeAlbums ;
	private $fbUsersImg200pxWidthSrcThatLikeAlbums ;
	private $context;


	// 	function __construct($url_page_str)
	// 	{
	// 		$this->url_page=$url_page_str;
	// 		$this->context=NULL;
	// 	}

	function __construct($url_page_str , $context)
	{
		$this->url_page=$url_page_str;
		$this->context=$context;

	}

	
	function getContents(){
	  $this->fb_page_albums_contents = file_get_contents($this->url_page.'?fields=albums', False, $this->context);
	  $this->fb_page_albums_photos_like = file_get_contents($this->url_page.'?fields=albums.fields(photos.fields(likes))', False, $this->context);
	  
	  $fbUserArray =   $this->extractFbUsers();
	  $this->fbUsersThatLikeAlbums = $fbUserArray [0];
	  $this->fbUsersImg50x50SrcThatLikeAlbums = $fbUserArray [1];
	  $this->fbUsersImg200pxWidthSrcThatLikeAlbums = $fbUserArray [2];
	}




	function __get($name)
	{
		return $this->$name;
	}
	function __set ($name, $value)
	{
		$this->$name = $value;
	}


	/**
	 * @param unknown_type $jsonOject is the http rest response of the albums contained in a facebook page
	 * example: https://graph.facebook.com/pauls.surfclub?fields=albums
	 * decoded in json object
	 * @return array userid=>user name of the users that like page albums
	 *
	 *
	 * 50x50 px:
	 * https://graph.facebook.com/<?= $fid ?>/picture
	 * width: 200px
	 * https://graph.facebook.com/<?= $fid ?>/picture?type=large
	 *
	 */
	public function extractFbUsers(){
		$map_UserId_UserName = array();
		$map_UserId_UserImg50x50Src= array();
		$map_UserId_UserImg200pxWidthSrc= array();
		// $albums = $json_response['albums'];
		// echo "response ".$response;
		$jsonOject = json_decode($this->fb_page_albums_contents);
		if( (!empty($jsonOject)) &&property_exists($jsonOject, 'albums')){
		$data = $jsonOject->albums->data;
		foreach ($data as $album){
			//echo "<br>".$album->id. "</br>";
			if(property_exists($album, 'likes')){
				$likes = $album->likes;
				foreach($likes as $like ){
					$data = $likes->data;
					foreach($data as $fb_user_id_name ) {
						// 					echo '</br>';
						$fid = $fb_user_id_name->id;
						$fname = $fb_user_id_name->name;

						// 					echo "name ".$fname;
						// 					echo "id ".$fb_user_id_name->id;
						$map_UserId_UserName[$fid]=$fname ;
						$map_UserId_UserImg50x50Src[$fid] = "https://graph.facebook.com/".$fid."/picture";
						$map_UserId_UserImg200pxWidthSrc[$fid] = "https://graph.facebook.com/".$fid."/picture?type=large";
					}
				}
			}
		}
		}
		
		
		$jsonOject = json_decode($this->fb_page_albums_photos_like);
		
		if( (!empty($jsonOject)) &&property_exists($jsonOject, 'albums')){
		  $data = $jsonOject->albums->data;
		  foreach ($data as $album){
		    //echo "<br>".$album->id. "</br>";
		    if(property_exists($album, 'likes')){
		      $likes = $album->likes;
		      foreach($likes as $like ){
		        $data = $likes->data;
		        foreach($data as $fb_user_id_name ) {
		          // 					echo '</br>';
		          $fid = $fb_user_id_name->id;
		          $fname = $fb_user_id_name->name;
		
		          // 					echo "name ".$fname;
		          // 					echo "id ".$fb_user_id_name->id;
		          $map_UserId_UserName[$fid]=$fname ;
		          $map_UserId_UserImg50x50Src[$fid] = "https://graph.facebook.com/".$fid."/picture";
		          $map_UserId_UserImg200pxWidthSrc[$fid] = "https://graph.facebook.com/".$fid."/picture?type=large";
		        }
		      }
		    }
		  }
		}
		
		
		
		$result = array($map_UserId_UserName,$map_UserId_UserImg50x50Src,$map_UserId_UserImg200pxWidthSrc );
		return $result ;
	}
	
	public function getfbUsersImg50x50AsFileObj(){
		$imagesFileArray = array();
		foreach ($this->fbUsersImg50x50SrcThatLikeAlbums as $key => $value){
			$image = file_get_contents($value,False, $this->context);
			$imagesFileArray[$key]=$image;
		}
		return $imagesFileArray;
	}
	
	public function testDrupalGetImageFromExtUrlAndSaveAsFile(){
			$image = file_get_contents('http://drupal.org/files/issues/druplicon_2.png',False, $this->context);
			$file = file_save_data($image, 'public://druplicon.png',FILE_EXISTS_REPLACE);
	}

}

?>