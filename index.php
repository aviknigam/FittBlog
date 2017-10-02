<?php

require __DIR__ . '/core/init.php';

$title = 'Daily Health and Fitness Stories!';
$description = "Fitness website";
?>

<!DOCTYPE html>

<html lang="en-US">
	<head>
		<!-- Header -->
			<?php include('includes/header.php'); ?>
	
	</head>

	<body>
		<!-- Navigation -->
			<?php include('includes/navbar.php'); ?>
		
		<!-- Main Content -->
			<?php include('includes/content.php') ?>
		
		<!-- Footer -->
			<?php include('includes/footer.php'); ?>
		
		<!-- Scripts -->
			<?php include('includes/scripts.php'); ?>
		
	</body>
</html>

<!-- category=$row[postCategory]&title=$row[postTitle]&
category=$row[postCategory]&title=$row[postTitle]& -->