<?php
$stmt = $conn->query("SELECT * FROM posts WHERE postCategory = '$category' ORDER BY postID desc");
while($row = $stmt->fetch_assoc()) {
    echo "$row[postTitle] <br />";
}