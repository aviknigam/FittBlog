<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

$conn = mysqli_connect("localhost", "root", "", "fitness");

$listing_query = "SELECT * FROM posts";
$listing_query_result = $conn->query($listing_query);


while ($row = $listing_query_result->fetch_array()){
	$listing_time = date('jS M Y', strtotime($row['postDate'])); 

	echo "<p>$row[postTitle]</p>";
	echo "<p>$row[postDesc]</p>";
	echo "<p>$listing_time</p>";
	echo str_replace("postID", $row['postID'], $row['postCont']);
	echo str_replace('postID', $row['postID'], $row['postImage']);

};
?>