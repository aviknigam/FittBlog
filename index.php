<?php

require __DIR__ . '/core/init.php';

$title = 'Daily Health and Fitness Stories!';
$description = "Health and fitness stories from around the world. Inspirational workouts, weight transformations and gym routines explained. Updated daily, follow us on Facebook and Instagram and allow us to help transform lives!";
?>

<!DOCTYPE html>

<html lang="en-US">
	<head>
		<!-- Header -->
			<?php include('includes/header.php'); ?>
			<!-- Facebook Open Graph Tags -->
				<meta property="og:title" content="Daily Health and Fitness Stories!">
				<meta property="og:type" content="website">
				<meta property="og:url" content="https://www.fittblog.com">
				<meta property="og:image" content="https://www.fittblog.com/assets/images/cover.png" />
				<meta property="og:description" content="Updated daily, follow us on Facebook and Instagram and allow us to help transform lives!">
				<meta property="article:publisher" content="https://www.facebook.com/pg/FittBlog-2028556034045030" />
				<meta property="article:author" content="https://www.facebook.com/pg/FittBlog-2028556034045030" />

			<!-- Twitter Summary Card -->
				<meta name="twitter:card" content="summary" />
				<meta name="twitter:title" content="Daily Health and Fitness Stories!" />
				<meta name="twitter:description" content="Updated daily, follow us on Facebook and Instagram and allow us to help transform lives!"/>
				<meta name="twitter:image" content="https://www.fittblog.com/assets/images/cover.png" />
	
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