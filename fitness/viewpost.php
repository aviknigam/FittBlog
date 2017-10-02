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
$title = htmlspecialchars_decode($row['postTitle']);
$description = htmlspecialchars_decode($row['postDescription']);

$date = date('jS M Y', strtotime($row['created_at']));

// INCLUDES AND BUILD GENERAL WEBPAGE
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../includes/header.php'; ?>
    </head>
    
    <body>
        <?php include '../includes/navbar.php'; ?>
        <?php include '../includes/ads.php'; ?>
        
        <div>
            <a class="btn btn-primary" href="/" role="button">Go Back</a>
            <h1><?= $title ?></h1>
            <p>Posted on <?= $date; ?></p>
            <p><?= htmlspecialchars_decode($row['postContent']); ?></p>
        </div>

    </body>
</html>




