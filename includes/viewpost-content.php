<?php
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
// if($row['updated_at'] > $row['created_at']) {
//     $date_post = "Published: " .date('jS F Y', strtotime($row['created_at'])). " | Updated: " . date('jS F Y', strtotime($row['updated_at']));
// } else {
//     $date_post = "Published: " .date('jS F Y', strtotime($row['created_at']));
// }
$date_post = "Published: " .date('jS F Y', strtotime($row['created_at']));

// ----------- GENERAL WEBPAGE ------------------------------
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <?php include 'header.social.php'; ?>
        <link rel="stylesheet" type="text/css" href="/assets/css/post.css?<?php echo time(); ?>">
    </head>
    
    <body>
        <!-- Main Content -->
			<div class="container">
            <!-- Navbar -->
                <?php include('navbar.php'); ?>

            <!-- Content -->
                <div class="post" itemscope itemtype="http://schema.org/NewsArticle">
                    <h1 class="post-lead"><?= $title ?></h1>

                    <div class="addthis_inline_share_toolbox mt-4"></div>
                    
                    <div class="mt-4"><?= $date_post; "<br/>"; ?></div>

                    <!-- Image -->
                        <?php 
                            if(empty($row['postImage'])) {
                                echo "<img class='img-fluid mt-4' src='/assets/images/$row[postID].jpg'>";
                            } else {
                                echo "<img class='img-fluid mt-4' src='$row[postImage]'>";
                            }
                        ?>

                        <!-- Initial Advertisement -->
                            <div class="mt-4">
                                <?php include 'ads-responsive.php'; ?> 
                            </div>

                        <!-- Post Content -->
                            <div class="post-content mt-4">
                                <?php
                                    $postAd_get = file_get_contents('../includes/ads-responsive.php');
                                    $main_post = htmlspecialchars_decode(str_replace("postAd", $postAd_get, $row['postContent']));
                                    echo $main_post;
                                ?>
                            </div>

                        <div class="addthis_inline_share_toolbox mt-4"></div>
                        <div class="mt-4">
                            <?php include 'ads-responsive.php'; ?> 
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="post-nav flex mt-4">
                        <?php 
                        $next_post = $conn->query("SELECT * FROM posts WHERE postID < $row[postID] ORDER BY postID DESC LIMIT 1");
                        $row = $next_post->fetch_assoc();
                        ?>
                        <a class="btn flex" <?="href='/" .$row['postCategory']. "/" .$row['postSlug']. "'";?>>Next Post <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Footer -->
                <?php include('footer.php'); ?>
            
        <!-- Scripts -->
            <?php include('scripts.php'); ?>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59d590f7f3ad1af4"></script>  
    </body>
</html>