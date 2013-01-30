<?php
require '../src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
    'appId'  => '344617158898614',
    'secret' => '6dc8ac871858b34798bc2488200e503d',
));

// Get User ID
// $user = $facebook->getUser();

$access_token = $facebook->getAccessToken();

$at="AAACEdEose0cBABzhefruvkuIZAHMee0VQoUJtSwikMvGm1UmrblZBXLI6VzkwJM3e8QW1o71LkNuhRgPxDIezrTlmG7ZAQWPa93U8heb3dfIrx4wZCmS";
$facebook->setAccessToken($at);

$user = $facebook->getUser();

echo "access_token" . $facebook->getAccessToken();

echo "user". $user;


?>