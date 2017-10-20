<!-- Notes
/includes/header.php - Google Analytics disabled

/includes/navbar.php - Admin links are showed, remove before commit 

    <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/admin/">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/login">Login</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="/admin/add-post">Add Post</a>
            </li> -->
            </ul>
        
        <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>-->
    </div>
-->









<?php

// error_reporting(E_ALL);
// ini_set('display_errors', true);

// $conn = mysqli_connect("localhost", "root", "", "fitness");

// $listing_query = "SELECT * FROM posts";
// $listing_query_result = $conn->query($listing_query);


// while ($row = $listing_query_result->fetch_array()){
// 	$listing_time = date('jS M Y', strtotime($row['postDate'])); 

// 	echo "<p>$row[postTitle]</p>";
// 	echo "<p>$row[postDesc]</p>";
// 	echo "<p>$listing_time</p>";
// 	echo str_replace("postID", $row['postID'], $row['postCont']);
// 	echo str_replace('postID', $row['postID'], $row['postImage']);

// };
?>