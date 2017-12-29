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
				<meta property="article:publisher" content="https://www.facebook.com/FittnessBlog/" />
				<meta property="article:author" content="https://www.facebook.com/FittnessBlog/" />

			<!-- Twitter Summary Card -->
				<meta name="twitter:card" content="summary" />
				<meta name="twitter:title" content="Daily Health and Fitness Stories!" />
				<meta name="twitter:description" content="Updated daily, follow us on Facebook and Instagram and allow us to help transform lives!"/>
				<meta name="twitter:image" content="https://www.fittblog.com/assets/images/cover.png" />
	
	</head>

	<body>
		<!-- Main Content -->
			<div class="container">
				<!-- Navbar -->
					<?php include('includes/navbar.php'); ?>

				<!-- Content -->
					<div class="primary-left">
						<div class="feature">
							<!-- add a modal -->
							<div class="feature-slide">
								<?php
									$stmt = $conn->query('SELECT * FROM posts ORDER BY postID desc LIMIT 1');
									$row = $stmt->fetch_assoc();
									$id = $row['postID'];
									echo "<a href='/$row[postCategory]/$row[postSlug]'>";
									if(empty($row['postImage'])) {
										echo "<img src='/assets/images/$row[postID].jpg'>";
									} else {
										echo "<img src='$row[postImage]'>";
									}
								?>
								<h2 class="feature-caption"><?= $row['postTitle']; ?></h2>
								</a>
							</div>
						</div>

						<div class="recent">
							<p class="catname">Recent Articles</p>
							<?php
								$stmt = $conn->query("SELECT * FROM posts WHERE postID < $id ORDER BY postID desc");
								while($row = $stmt->fetch_assoc()) {
									echo "
										<article class='recent-article' itemscope itemtype='http://schema.org/NewsArticle'>
											<a href='/$row[postCategory]/$row[postSlug]'>";
											if(empty($row['postImage'])) {
												echo "<img class='article-img' src='/assets/images/$row[postID].jpg'>";
											} else {
												echo "<img class='article-img' src='$row[postImage]'>";
											}
									echo "
												<h2 class='article-h2'>$row[postTitle]</h2>
												<div class='article-p'>$row[postDescription]</div>
											</a>
										</article>";
								}
							?>
						</div>
					</div>	

				<!-- Footer -->
					<?php include('includes/footer.php'); ?>
				
			</div>				

		<!-- Scripts -->
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59d590f7f3ad1af4"></script>  
	</body>
</html>