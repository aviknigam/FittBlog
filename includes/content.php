<div class="container-fluid main-content">
    <div class="row">
        <!-- Latest Posts -->
            <div class="col-md-6">
                <h1 class="heading">Latest Posts</h1>

                <?php

                $stmt = $conn->query('SELECT * FROM posts ORDER BY postID desc LIMIT 5');

                while($row = $stmt->fetch_assoc()) {
                    echo 
                        "<div class='card bg-light'>
                            <a href='/$row[postCategory]/$row[postSlug]'>
                                <img class='card-img-top' src='/assets/images/$row[postID].jpg'>
                            </a>
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
            <!-- <div class="col-md-6">
                <h1 class="heading">Trending</h1>
                
            </div>	 -->
    </div>
</div>