<?php

function sanitize($data) {
	$conn = mysqli_connect("localhost", "root", "", "fitness");
	return mysqli_real_escape_string($conn, $data);
}

function dd($data) {
	echo '<pre>';
	die(var_dump($data));
	echo '</pre>';
}