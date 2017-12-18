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
			<div class="fb-container flex">
				<!-- Sidebar -->
					<?php include 'includes/sidebar.php'; ?>

				<!-- Main Content -->
					<div class="fb-main-content flex">
						<h1 class="fb-heading">Latest Posts</h1>
							<div class="fb-posts flex">
								<?php

								$stmt = $conn->query('SELECT * FROM posts ORDER BY postID desc');

								while($row = $stmt->fetch_assoc()) {
									echo 
										"<div class='fb-card'>
											<a href='/$row[postCategory]/$row[postSlug]'>";
									
									if(empty($row['postImage'])) {
										echo "<img src='/assets/images/$row[postID].jpg'>";
									} else {
										echo "<img src='$row[postImage]'>";
									}
									
									echo
											"</a>
											<div class='fb-card-body'>
												<h4 class='fb-card-title'><a href='/$row[postCategory]/$row[postSlug]'>$row[postTitle]</a></h4>
												<p class='fb-card-text'>" .substr($row['postDescription'], 0, 110) ."...</p>
												<a href='/$row[postCategory]/$row[postSlug]'><u>Read more...</u></a>
											</div>
										</div>";
								};

								?>
							</div>
					</div>
			</div>
		
		<!-- Footer -->
			<?php include('includes/footer.php'); ?>
		
		<!-- Scripts -->
			<?php include('includes/scripts.php'); ?>
	</body>
</html>