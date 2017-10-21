<?php
require __DIR__ . '/../core/init.php';

$urlSlug = sanitize($_GET['slug']);

// Prepare the statement -> not querying just yet
$stmt = $conn->prepare('SELECT * FROM posts WHERE postSlug = ?');

// Bind the parameters
$stmt->bind_param("s", $postSlug);
$postSlug = $urlSlug;

// Execute query
$stmt->execute();

// Need get_result() to give the result to
$result = $stmt->get_result();

// Exit if we cannot find the post in SQL
if(!$result->num_rows > 0) {
    header("Location: /404");
    exit;
}

// ------------ IF THERE IS A POST --------------------------

// Fetch assoc turns it into a usable array
$row = $result->fetch_assoc();

// Variable declaration for header include
$title = strip_tags($row['postTitle']);
$description = strip_tags($row['postDescription']);
if(empty($row['postImage'])) {
    $social = "http://fittblog.com/assets/images/$row[postID].jpg";
} else {
    $social = $row['postImage'];
}


// Check updated vs created date
if($row['updated_at'] > $row['created_at']) {
    $date_updated = "Updated: " . date('jS F Y', strtotime($row['updated_at']));
} else {
    $date_created = "Published on: " .date('jS F Y', strtotime($row['created_at']));
}
// if (date('jS F Y', strtotime($row['updated_at'])) > date('jS F Y', strtotime($row['created_at']))) {
//     $date_posted_updated = 'Updated';
//     $date = date('jS F Y', strtotime($row['updated_at']));
// } else {
//     $date_posted_updated = 'Posted';
//     $date = date('jS F Y', strtotime($row['created_at']));
// }

// ----------- GENERAL WEBPAGE ------------------------------
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../includes/header.php'; ?>
        <?php include '../includes/header.social.php'; ?>
        <link rel="stylesheet" type="text/css" href="/assets/css/post.css?<?php echo time(); ?>">
    </head>
    
    <body>
        <?php include '../includes/navbar.php'; ?>
        
        <!-- Main Content -->
            <div class="container-fluid main-post-content">
                <div class="row">
                    <div class="col-md-2">

                    </div>

                    <!-- MAIN POST -->
                        <div class="col-md-8">
                            <h1 class="heading"><?= $title ?></h1>
                            <div class="mt-4"><?= $date_created; "<br/>"; $date_updated ?></div>
                            <div class="addthis_inline_share_toolbox mt-4"></div>
                            <?php if(empty($row['postImage'])) { echo "<img class='img-fluid mt-4' src='/assets/images/$row[postID].jpg'>"; } ?>
                            
                            <div class="mt-4">
                                <?php include '../includes/ads-responsive.php'; ?> 
                            </div>

                            <div class="post-content mt-4">
                                <?php
                                    $postAd_get = file_get_contents('../includes/ads-responsive.php');
                                    $main_post = htmlspecialchars_decode(str_replace("postAd", $postAd_get, $row['postContent']));
                                    echo $main_post;
                                ?>
                            </div>
                            <div class="addthis_inline_share_toolbox mt-2"></div>
                            <div class="mt-4">
                                <?php include '../includes/ads-responsive.php'; ?> 
                            </div>
                            <a class="btn btn-primary" href="/" role="button">Go Back</a>
                        </div>

                    <!-- ADS -->
                    <div class="col-md-2">

                    </div>
                </div>
            </div>

        <!-- Scripts -->
            <?php include('../includes/scripts.php'); ?>
    </body>
</html>