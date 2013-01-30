<?php

/**
 * @param unknown_type $jsonOject is the http rest response of the albums contained in a facebook page
 * example: https://graph.facebook.com/pauls.surfclub?fields=albums
 * decoded in json object 
 * @return array userid=>user name of the users that like page albums 
 *  
 */
// function extractFbUsers($jsonOject){
	
// 	$result = array();
	
// 	// $albums = $json_response['albums'];
	
// 	// echo "response ".$response;
// 	$data = $jsonOject->albums->data;
	
// 	foreach ($data as $album){
// 		echo "<br>".$album->id. "</br>";
// 		$likes = $album->likes;
// 		foreach($likes as $like ){
// 			$data = $likes->data;
// 			foreach($data as $fb_user_id_name ) {
// 				echo '</br>';
// 				$fid = $fb_user_id_name->id;
// 				$fname = $fb_user_id_name->name;
	
// 				echo "name ".$fname;
// 				echo "id ".$fb_user_id_name->id;
// 				$result[$fid]=$fname ;
	
// 			}
	
// 		}
// 	}
// 	return $result;
// }



?>