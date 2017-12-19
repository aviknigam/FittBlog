<?php
require __DIR__ . '/../core/init.php';

// Variables Set
$title = 'Admin Panel';
$description = 'Admin Panel';
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<!-- Header -->
		<?php include('../includes/header.php'); ?>
		<link rel="stylesheet" type="text/css" href="/assets/css/admin.css?<?php echo time(); ?>">
	</head>

	<body>
		<!-- Navigation -->
			<?php include('../includes/navbar.php'); ?>

		<!-- Container -->
			<div class="fb-container flex">
				<!-- Sidebar -->
					<?php include('../includes/sidebar.php'); ?>
			
				<!-- Main Content -->
					<div class="fb-main-content admin-section flex">           
						<!-- ADMIN LOGIN -->
							<?php 
								if (!isset($_SESSION['admin'])) {
									echo '
										<form class="fb-login-form flex" action="/admin/login.php" method="post">
											<div class="form-field flex">
												<i class="fas fa-envelope fa-fw fa-2x"></i>
												<input type="email" name="email" size="25" placeholder="Email" required>
											</div>
											<div class="fb-form-field flex">
												<i class="fas fa-lock fa-fw fa-2x"></i>
												<input type="password" name="password" size="25" placeholder="Password" required>
											</div>';
											// include 'includes/recaptcha.php';
											echo '<button type="submit" class="aa">Login</button>
										</form> 
									';

									die();
								}
							?>
						
						<!-- Links -->
							<div class="fb-admin-links flex">
								<a href="/admin/add-post">Add Post</a> | <a href="/admin/sitemap-gen">Sitemap Generator</a>
							</div>

						<!-- Table of Posts -->
							<div class="fb-table-responsive">
								<table>
									<thead>
										<tr>
											<th>Post ID</th>
											<th>Title</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
											try {

												$stmt = $conn->query('SELECT * FROM posts ORDER BY postID DESC');
												while($row = $stmt->fetch_assoc()){
													
													echo '<tr>';
													echo '<td>' .$row['postID']. '</td>';
													echo '<td><a href="/fitness/' . $row['postSlug']. '">'.$row['postTitle'].'</a></td>';
													echo '<td>'.date('jS M Y', strtotime($row['created_at'])).'</td>';
													?>

													<td>
														<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> | 
														<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
													</td>
													
													<?php 
													echo '</tr>';

												}

											} catch(PDOException $e) {
												echo $e->getMessage();
											}
										?>
									</tbody>
								</table>
							</div>

		<!-- Scripts -->
			<?php include('../includes/scripts.php'); ?>
			
	</body>
</html>


