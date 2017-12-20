<?php
require __DIR__ . '/../core/init.php';

//If not logged in redirect to login page

if (!isset($_SESSION['admin'])) {
	header('Location: ./');
}

// Variables Set
$title = 'Add Post';
$description = 'Add Post';
		
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
			<div class="fb-container admin-section flex">
				<!-- Sidebar -->
					<?php include('../includes/sidebar.php'); ?>
			
				<!-- Main Content -->
					<div class="fb-main-content flex mt-4">   

						<a href="./" style="text-align: center;">Admin Index</a>

						<h1 class="fb-heading">Add Post</h2>

						<?php

						//Submit form if processed
						if(isset($_POST['submit'])) {

							// $_POST = array_map( 'stripslashes', $_POST );
							
							$postTitle = $_POST['postTitle'];
							$postSlug = $_POST['postSlug'];
							$postDescription = $_POST['postDescription'];
							$postContent = $_POST['postContent'];
							$postCategory = $_POST['postCategory'];
							$postTags = $_POST['postTags'];
							$postImage = $_POST['postImage'];

							//very basic validation
							if($postTitle =='') {
								$error[] = 'Please enter the title.';
							}

							if($postDescription =='') {
								$error[] = 'Please enter the description.';
							}

							if($postContent =='') {
								$error[] = 'Please enter the content.';
							}
							
							if(!isset($error)) {

								try {

									//insert into database
									$stmt = $conn->prepare('INSERT INTO posts (postTitle, postSlug, postDescription, postContent, postCategory, postTags, postImage) VALUES (?, ?, ?, ?, ?, ?, ?)');
									$stmt->bind_param("sssssss", $postTitle, $postSlug, $postDescription, $postContent, $postCategory, $postTags, $postImage);
									$postTitle = $postTitle;
									$postSlug = $postSlug;
									$postDescription = $postDescription;
									$postContent = $postContent;
									$postCategory = $postCategory;
									$stmt->execute();
									
									// Target Directory
									$postImage = $_FILES['postImage']['name'];
									$postImage_tmp = $_FILES['postImage']['tmp_name'];
									
									$target_dir = '../assets/images/';
									$target_file = $target_dir . basename($_FILES["postImage"]["name"]);
									
									if (move_uploaded_file($postImage_tmp, $target_file)) {
										//redirect to index page
										header('Location: ./');
									}

									header("Location: ./");
									exit();

								} catch(PDOException $e) {
									echo $e->getMessage();
								}

							}

						}

						//check for any errors
						if(isset($error)) {
							foreach($error as $error) {
								echo '<p class="error">'.$error.'</p>';
							}
						}
						?>

						<form action='' method="POST" enctype="multipart/form-data">
							<div class="fb-form-group">
								<label for="postTitle">Title</label>
								<input type='text' class="fb-form-field" id="postTitle" name="postTitle" value="<?php if(isset($error)){ echo $_POST['postTitle'];}?>">
							</div>
							<div class="fb-form-group">
								<label for="postSlug">Slug</label>
								<input type='text' class="fb-form-field" id="postSlug" name="postSlug" placeholder="with date on the end" value="<?php if(isset($error)){ echo $_POST['postSlug'];}?>">
							</div>
							<div class="fb-form-group">
								<label for="postDescription">Description</label><br />
								<textarea class="fb-form-field" id="postDescription" name="postDescription" rows='3'><?php if(isset($error)){ echo $_POST['postDescription'];}?></textarea>
							</div>
							<div class="fb-form-group">
								<label for="postContent">Content</label><br />
								<textarea class="fb-form-field editor" name="postContent"  rows='25'><?php if(isset($error)){ echo $_POST['postContent'];}?></textarea>
							</div>
							<div class="fb-form-group">
								<label for="postCategory">Category</label>
								<input type='text' id="postCategory" class="fb-form-field"  name="postCategory" value="<?php if(isset($error)){ echo $_POST['postCategory'];}?>">
							</div>
							<div class="fb-form-group">
								<label for="postTags">Tags</label>
								<input type='text' id="postTags" class="fb-form-field"  name="postTags" value="<?php if(isset($error)){ echo $_POST['postTags'];}?>">
							</div>
							<div class="fb-form-group">
								<label for="postImage">Image URL (optional)</label>
								<input type='text' id="postImage" class="fb-form-field"  name="postImage" value="<?php if(isset($error)){ echo $_POST['postImage'];}?>">
							</div>
							<input type="file" name="postImage" id="postImage" />
							<input type="submit" class="fb-submit" name="submit" value="submit">
						</form>
					</div>
			</div>
			
		<!-- CMS Editor -->
			<?php include('../includes/editor.php'); ?>
		
		<!-- Scripts -->
			<?php include('../includes/scripts.php'); ?>
	</body>
</html>