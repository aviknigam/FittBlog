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
	</head>

	<body>
		<!-- Navigation -->
			<?php include('../includes/navbar.php'); ?>

		<!-- Main Content -->
			<div class="container">
				<p><a href="./">Admin Index</a></p>

				<h1 class="heading">Edit Post</h2>

				<?php
					// GET URL with sanitized statement
					$urlID = sanitize($_GET['id']);

					// Query Database
					$stmt1 = $conn->query("SELECT * FROM posts WHERE postID = $urlID");
					if(!$stmt1->num_rows > 0) {
						echo 
							"<div class='alert alert-danger' role='alert'>
								No post with a ID of '$urlID' found
							</div>";
						die();
					}

					//Submit form if processed
					if(isset($_POST['Submit'])) {
						
						// Set Variables
						$postTitle = $_POST['postTitle'];
 /* Fix automatic slug later */						$postSlug = $_POST['postSlug'];
						$postDescription = $_POST['postDescription'];
						$postContent = $_POST['postContent'];
						$postCategory = $_POST['postCategory'];
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
								$stmt2 = $conn->prepare("UPDATE posts SET postTitle = ?, postSlug = ?, postDescription = ?, postContent = ?, postCategory = ?, postImage = ? WHERE postID = ?");
								$stmt2->bind_param("sssssss", $postTitle, $postSlug, $postDescription, $postContent, $postCategory, $postImage, $postID);
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
							echo '<p class="alert-danger">'.$error.'</p>';
						}
					}
				?>

				<!-- Form -->
					<?php $row = $stmt1->fetch_assoc(); ?>
					<form action='' method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="postTitle">Title</label>
							<input type='text' id="postTitle" class="form-control" name="postTitle" value="<?php if(isset($error)){ echo $_POST['postTitle'];} else { echo $row['postTitle'];}?>">
						</div>
						<div class="form-group">
							<label for="postSlug">Slug</label>
							<input type='text' id="postSlug" class="form-control" name="postSlug" value="<?php if(isset($error)){ echo $_POST['postSlug'];} else { echo $row['postSlug'];}?>">
						</div>
						<div class="form-group">
							<label for="postDescription">Description</label><br />
							<textarea id="postDescription" class="form-control" name="postDescription" rows='3'><?php if(isset($error)){ echo $_POST['postDescription'];} else { echo $row['postDescription'];}?></textarea>
						</div>
						<div class="form-group">
							<label for="postContent">Content</label><br />
							<textarea id="postContent" class="form-control editor" name="postContent"  rows='20'><?php if(isset($error)){ echo $_POST['postContent'];} else { echo $row['postContent'];}?></textarea>
						</div>
						<div class="form-group">
							<label for="postCategory">Category</label>
							<input type='text' id="postCategory" class="form-control"  name="postCategory" value="<?php if(isset($error)){ echo $_POST['postCategory'];} else { echo $row['postCategory'];}?>">
						</div>
						<div class="form-group">
							<label for="postImage">Image URL (optional)</label>
							<input type='text' id="postImage" class="form-control"  name="postImage" value="<?php if(isset($error)){ echo $_POST['postImage'];} else { echo $row['postImage'];}?>">
						</div>
						<input type="file" name="postImage" id="postImage" />
						<input type="submit" class="btn btn-primary" name="Submit" value="Submit">
					</form>
				
			</div>
			
		<!-- CMS Editor -->
		<?php include('../includes/editor.php'); ?>

		<!-- Scripts -->
			<?php include('../includes/scripts.php'); ?>

	</body>
</html>