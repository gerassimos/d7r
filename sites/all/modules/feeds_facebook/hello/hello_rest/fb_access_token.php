<?php

// $url = 'https://graph.facebook.com/pauls.surfclub';
// $data = array("fields" => "albums");

// $response = callAPI('GET', $url, $data );
// $json_response = json_decode($response);

$at="AAACEdEose0cBABzhefruvkuIZAHMee0VQoUJtSwikMvGm1UmrblZBXLI6VzkwJM3e8QW1o71LkNuhRgPxDIezrTlmG7ZAQWPa93U8heb3dfIrx4wZCmS";


$r_contents = file_get_contents("https://graph.facebook.com/pauls.surfclub?access_token=".$at."&fields=feed");
$json_r_contents = json_decode($r_contents);







?>