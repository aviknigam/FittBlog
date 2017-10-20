<?php
require __DIR__ . '/../core/init.php';

//if not logged in redirect to login page
// if(!$user->is_logged_in()){ header('Location: login.php'); }

// Variables Set
$title = 'Admin Panel';
$description = 'Admin Panel';
		
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<!-- Header -->
			<?php include('../includes/header.php'); ?>
	</head>

	<body>
		<!-- Navigation -->
			<?php include('../includes/navbar.php'); ?>
		
		<!-- Main Content -->
			<div class="container">

				<p><a href="./">Admin Index</a></p>

				<h1 class="heading">Add Post</h2>

				<?php

				//Submit form if processed
				if(isset($_POST['submit'])) {

					// $_POST = array_map( 'stripslashes', $_POST );
					
					$postTitle = $_POST['postTitle'];
					$postSlug = $_POST['postSlug'];
					$postDescription = $_POST['postDescription'];
					$postContent = $_POST['postContent'];
					$postCategory = $_POST['postCategory'];

					//collect form data
					// extract($_POST);

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
							$stmt = $conn->prepare('INSERT INTO posts (postTitle, postSlug, postDescription, postContent, postCategory) VALUES (?, ?, ?, ?, ?)');
							$stmt->bind_param("sssss", $postTitle, $postSlug, $postDescription, $postContent, $postCategory);
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
					<div class="form-group">
						<label for="postTitle">Title</label>
						<input type='text' class="form-control" id="postTitle" name="postTitle" value="<?php if(isset($error)){ echo $_POST['postTitle'];}?>">
					</div>
					<div class="form-group">
						<label for="postSlug">Slug</label>
						<input type='text' class="form-control" id="postSlug" name="postSlug" value="<?php if(isset($error)){ echo $_POST['postSlug'];}?>">
					</div>
					<div class="form-group">
						<label for="postDescription">Description</label><br />
						<textarea class="form-control" id="postDescription" name="postDescription" rows='3'><?php if(isset($error)){ echo $_POST['postDescription'];}?></textarea>
					</div>
					<div class="form-group">
						<label for="postContent">Content</label><br />
						<textarea class="form-control editor" name="postContent"  rows='20'><?php if(isset($error)){ echo $_POST['postContent'];}?></textarea>
					</div>
					<div class="form-group">
						<label for="postCategory">Category</label>
						<input type='text' id="postCategory" class="form-control"  name="postCategory" value="<?php if(isset($error)){ echo $_POST['postCategory'];}?>">
					</div>
					<input type="file" name="postImage" id="postImage" />
					<input type="submit" class="btn btn-primary" name="submit" value="submit">

				</form>

			</div>
			
		<!-- CMS Editor -->
		<?php include('../includes/editor.php'); ?>
		
		<!-- Scripts -->
			<?php include('../includes/scripts.php'); ?>
	
	</body>
</html>