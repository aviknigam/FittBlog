<?php

$captcha = $_POST['g-recaptcha-response'];

if (!$captcha) {
	echo '<h2>Please check the the captcha form.</h2>';
	die();
}

$secretkey = "6LfsKiMUAAAAAJOLOFJCPn6VorEKOlmKds6DQvnn";
$ip = $_SERVER['REMOTE_ADDR'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" .$secretkey. "&response=" .$captcha. "&remoteip=" .$ip);
$responsekeys = json_decode($response, true);

if (intval($responsekeys["success"]) !== 1) {
	echo '<h2>Are you really a human? Please go back and fill in the captcha checks!</h2>';
	die();
}