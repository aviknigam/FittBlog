<?php

function sanitize($data) {
	$conn = mysqli_connect("localhost", "produser", "prodpass", "fitness");
	return mysqli_real_escape_string($conn, $data);
}

function dd($data) {
	echo '<pre>';
	die(var_dump($data));
	echo '</pre>';
}

function render($file){
    ob_start();
    include $file;
    return ob_get_clean();
  }