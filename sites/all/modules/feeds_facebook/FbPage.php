<?php

class FbPage{

	private $url_page;
	private $fb_page_albums_contents;
	private $fb_page_albums_photos_like;
	private $fbUsersThatLikeAlbums ;
	private $fbUsersImg50x50SrcThatLikeAlbums ;
	private $fbUsersImg200pxWidthSrcThatLikeAlbums ;
	private $context;


	function __construct($url_page_str , $context)
	{
		$this->url_page=$url_page_str;
		$this->context=$context;

	}

	
	function getContents(){
	  $this->fb_page_albums_contents = file_get_contents($this->url_page.'?fields=albums', False, $this->context);
// 	  $this->fb_page_albums_photos_like = file_get_contents($this->url_page.'?fields=albums.fields(photos.fields(likes))', False, $this->context);
	  
	  $this->fb_page_albums_photos_like = file_get_contents($this->url_page.'?fields=albums.limit(2).fields(photos.fields(source,likes))', False, $this->context);
	  
	  //pauls.surfclub?fields=albums.fields(photos.fields(source,likes))
	  //pauls.surfclub?fields=albums.limit(10).fields(photos.fields(source,likes))
	  //pauls.surfclub?fields=albums.limit(2).fields(photos.fields(source,likes))
	  
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
	 * 
	 * @return array of all the users  
	 * a) that like page's albums
	 * b) that like page's photos
	 * 
	 * $map_UserId_UserName userid=>'user_name' of the users that like
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
		
		$jsonOject = json_decode($this->fb_page_albums_contents);
		if( (!empty($jsonOject)) &&property_exists($jsonOject, 'albums')){
			$data = $jsonOject->albums->data;
			foreach ($data as $album){
				if(property_exists($album, 'likes')){
					$likes = $album->likes;
					foreach($likes as $like ){
						$data = $likes->data;
						foreach($data as $fb_user_id_name ) {
							$fid = $fb_user_id_name->id;
							$fname = $fb_user_id_name->name;
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
				if(property_exists($album, 'photos')){
					$data_photos = $album->photos->data;
					foreach ($data_photos as $photo){
						if(property_exists($photo, 'likes')){
							$likes = $photo->likes;
							foreach($likes as $like ){
								$data = $likes->data;
								foreach($data as $fb_user_id_name ) {
									$fid = $fb_user_id_name->id;
									$fname = $fb_user_id_name->name;
									$map_UserId_UserName[$fid]=$fname ;
									$map_UserId_UserImg50x50Src[$fid] = "https://graph.facebook.com/".$fid."/picture";
									$map_UserId_UserImg200pxWidthSrc[$fid] = "https://graph.facebook.com/".$fid."/picture?type=large";
								}
							}
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