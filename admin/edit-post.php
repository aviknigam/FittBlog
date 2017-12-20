<?php
require __DIR__ . '/../core/init.php';

//If not logged in redirect to login page

if (!isset($_SESSION['admin'])) {
	header('Location: ./');
}

// Variables Set
$title = 'Edit Post';
$description = 'Edit Post';

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

						<h1 class="fb-heading">Edit Post</h2>

						<?php
							// GET URL with sanitized statement
							$urlID = sanitize($_GET['id']);

							// Query Database
							$stmt1 = $conn->query("SELECT * FROM posts WHERE postID = $urlID");
							if(!$stmt1->num_rows > 0) {
								echo 
									"<div class='error' role='alert'>
										No post with a ID of '$urlID' found
									</div>";
								die();
							}

							//Submit form if processed
							if(isset($_POST['submit'])) {
								
								// Set Variables
								$postTitle = $_POST['postTitle'];
		/* Fix automatic slug later */						$postSlug = $_POST['postSlug'];
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
								
								// No ERRORS -> SUBMIT
								if(!isset($error)){
									try {
										//insert into database
										$stmt2 = $conn->prepare("UPDATE posts SET postTitle = ?, postSlug = ?, postDescription = ?, postContent = ?, postCategory = ?, postTags = ?, postImage = ? WHERE postID = ?");
										$stmt2->bind_param("ssssssss", $postTitle, $postSlug, $postDescription, $postContent, $postCategory, $postTags, $postImage, $postID);
										$postID = $urlID;
										$stmt2->execute();
										
										// Target Directory
										$postImage = $_FILES['postImage']['name'];
										$postImage_tmp = $_FILES['postImage']['tmp_name'];
										
										$target_dir = '../assets/images/';
										$target_file = "$target_dir" . "$postID" . "." . pathinfo($_FILES['postImage']['name'],PATHINFO_EXTENSION);
										
										if(move_uploaded_file($postImage_tmp, $target_file)) {
											header("Location: ./");
											exit();
										}
										
										header("Location: ./");
										exit();

									} catch(PDOException $e) {
										echo $e->getMessage();
									}
								}
							}
							
							//Check for any errors
							if(isset($error)) {
								foreach($error as $error){
									echo '<p class="error">' .$error. '</p>';
								}
							}
						?>

						<!-- Form -->
							<?php $row = $stmt1->fetch_assoc(); ?>
							<form action='' method="POST" enctype="multipart/form-data">
								<div class="fb-form-group">
									<label for="postTitle">Title</label>
									<input type='text' id="postTitle" class="fb-form-field" name="postTitle" value="<?php if(isset($error)){ echo $_POST['postTitle'];} else { echo $row['postTitle'];}?>">
								</div>
								<div class="fb-form-group">
									<label for="postSlug">Slug</label>
									<input type='text' id="postSlug" class="fb-form-field" name="postSlug" value="<?php if(isset($error)){ echo $_POST['postSlug'];} else { echo $row['postSlug'];}?>">
								</div>
								<div class="fb-form-group">
									<label for="postDescription">Description</label><br />
									<textarea id="postDescription" class="fb-form-field" name="postDescription" rows='3'><?php if(isset($error)){ echo $_POST['postDescription'];} else { echo $row['postDescription'];}?></textarea>
								</div>
								<div class="fb-form-group">
									<label for="postContent">Content</label><br />
									<textarea id="postContent" class="fb-form-field editor" name="postContent"  rows='25'><?php if(isset($error)){ echo $_POST['postContent'];} else { echo $row['postContent'];}?></textarea>
								</div>
								<div class="fb-form-group">
									<label for="postCategory">Category</label>
									<input type='text' id="postCategory" class="fb-form-field"  name="postCategory" value="<?php if(isset($error)){ echo $_POST['postCategory'];} else { echo $row['postCategory'];}?>">
								</div>
								<div class="fb-form-group">
									<label for="postTags">Tags</label>
									<input type='text' id="postTags" class="fb-form-field"  name="postTags" value="<?php if(isset($error)){ echo $_POST['postTags'];} else { echo $row['postTags'];}?>">
								</div>
								<div class="fb-form-group">
									<label for="postImage">Image URL (optional)</label>
									<input type='text' id="postImage" class="fb-form-field"  name="postImage" value="<?php if(isset($error)){ echo $_POST['postImage'];} else { echo $row['postImage'];}?>">
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