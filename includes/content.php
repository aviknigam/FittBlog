<div class="container-fluid main-content">
    <div class="row">
        <!-- Latest Posts -->
            <div class="col-md-6">
                <h1 class="heading">Latest Posts</h1>

                <?php

                $stmt = $conn->query('SELECT * FROM posts ORDER BY postID desc LIMIT 5');

                while($row = $stmt->fetch_assoc()) {
                    echo 
                        "<div class='card bg-light mb-4'>
                            <a href='/$row[postCategory]/$row[postSlug]'>";
                    
                    if(empty($row['postImage'])) {
                        echo "<img class='card-img-top' src='/assets/images/$row[postID].jpg'>";
                    } else {
                        echo "<img class='card-img-top' src='$row[postImage]'>";
                    }
                    
                    echo
                            "</a>
                            <div class='card-body'>
                                <h4 class='card-title'><a href='/$row[postCategory]/$row[postSlug]'>$row[postTitle]</a></h4>
                                <p class='card-text'>$row[postDescription]</p>
                                <a href='/$row[postCategory]/$row[postSlug]'><u>Read more...</u></a>
                            </div>
                        </div>";
                };

                ?>
            </div>

        <!-- Trending -->
            <div class="col-md-6 trending">
                <h1 class="heading">Trending!</h1>
                <div class="list-group">
                    
                    <?php

                    $stmt = $conn->query('SELECT * FROM posts WHERE postID IN (1, 2, 3, 4)');
                    $s = 1;
                    while(($row = $stmt->fetch_assoc()) && $s < 5) {
                        echo
                            "<a href='/$row[postCategory]/$row[postSlug]' class='list-group-item list-group-item-action'>
                                <span class='h5'><u>$row[postTitle]</u></span>
                            </a>";
                        $s++;
                    }
                    // <img class='img-fluid' src='/assets/images/$row[postID].jpg'>
                    ?>
                </div>
            </div>	
    </div>
</div>