<?php

$url = 'https://graph.facebook.com/pauls.surfclub';
$data = array("fields" => "albums");

$response = callAPI('GET', $url, $data );
$json_response = json_decode($response);

$r_contents = file_get_contents('https://graph.facebook.com/pauls.surfclub?fields=albums');
$json_r_contents = json_decode($r_contents);

$f_id_name_array = array();


echo "ALL *************0";
foreach ($f_id_name_array as $key => $value){
  echo $key." -- ".$value."<br />";
  
}




/**
 * @param $method : POST, PUT, GET etc
 * @param unknown $url
 * @param string $data : array("param" => "value") ==> index.php?param=value
 * @return mixed
 */
function callAPI($method, $url, $data = false)
{
  $curl = curl_init();

  switch ($method)
  {
    case "POST":
      curl_setopt($curl, CURLOPT_POST, 1);

      if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      break;
    case "PUT":
      curl_setopt($curl, CURLOPT_PUT, 1);
      break;
    default:
      if ($data)
        $url = sprintf("%s?%s", $url, http_build_query($data));
  }

  // Optional Authentication:
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($curl, CURLOPT_USERPWD, "username:password");

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  return curl_exec($curl);
}

?>