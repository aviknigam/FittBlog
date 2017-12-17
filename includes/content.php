<div class="fb-container flex">
    <!-- Sidebar -->
        <div class="fb-sidebar flex">
            
        </div>

    <!-- Main Content -->
        <div class="fb-main-content flex">
            <h1 class="fb-heading flex">Latest Posts</h1>
                <div class="fb-posts flex">
                    <?php

                    $stmt = $conn->query('SELECT * FROM posts ORDER BY postID desc');

                    while($row = $stmt->fetch_assoc()) {
                        echo 
                            "<div class='fb-card'>
                                <a href='/$row[postCategory]/$row[postSlug]'>";
                        
                        if(empty($row['postImage'])) {
                            echo "<img src='/assets/images/$row[postID].jpg'>";
                        } else {
                            echo "<img src='$row[postImage]'>";
                        }
                        
                        echo
                                "</a>
                                <div class='fb-card-body'>
                                    <h4 class='fb-card-title'><a href='/$row[postCategory]/$row[postSlug]'>$row[postTitle]</a></h4>
                                    <p class='fb-card-text'>" .substr($row['postDescription'], 0, 110) ." ...</p>
                                    <a href='/$row[postCategory]/$row[postSlug]'><u>Read more...</u></a>
                                </div>
                            </div>";
                    };

                    ?>
                </div>
        </div>
</div>