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
    header("Location: /");
    exit;
}