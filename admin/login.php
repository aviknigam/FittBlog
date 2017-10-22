<?php
require __DIR__ . '/../core/init.php';

// Gather input
$email = sanitize($_POST['email']);
$password = sanitize($_POST['password']);

// ReCaptcha Checks
// require '../core/functions/recaptchacheck.php';

// Unhash the password
$stmt_sql_find_hash = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
$stmt_sql_find_hash->bind_param("s", $stmt_email);
$stmt_email = $email;
$stmt_sql_find_hash->execute();
$row_find_hash = ($stmt_sql_find_hash->get_result())->fetch_assoc();
$hash_password = $row_find_hash['password'];
$hash = password_verify($password, $hash_password);

// Check row association 
$stmt_sql_login_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
$stmt_sql_login_user->bind_param("ss", $stmt_email, $hash_password);
$stmt_sql_login_user->execute();


// Run Check IF statement
if ($hash == 0) {
	echo '<span style="color: red;">Your IP address and device details have been recorded and sent to the site security team.</span>';
	die();

} elseif (!$row_login_user = ($stmt_sql_login_user->get_result())->fetch_assoc()) {
	echo '<span style="color: red;">Your IP address and device details have been recorded and sent to the website security team.</span>';

} else { 
	$_SESSION["admin"] = "admin";
	header("Location: ./");
}