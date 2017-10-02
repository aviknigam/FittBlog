<?php
require __DIR__ . '/../core/init.php';

// Variables Set
$title = 'Admin Panel';
$description = 'Admin Panel';
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <!-- Header -->
        <?php include('../includes/header.php'); ?>
	</head>

	<body>
		<!-- Navigation -->
			<?php include('../includes/navbar.php'); ?>
        
        <!-- Main Content -->
            <a class="nav-link" href="/admin/add-post">Add Post</a>

        <!-- Table of Posts -->
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                    try {

                        $stmt = $conn->query('SELECT postID, postTitle, created_at FROM posts ORDER BY postID DESC');
                        while($row = $stmt->fetch_assoc()){
                            
                            echo '<tr>';
                            echo '<td>'.$row['postTitle'].'</td>';
                            echo '<td>'.date('jS M Y', strtotime($row['created_at'])).'</td>';
                            ?>

                            <td>
                                <a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> | 
                                <a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
                            </td>
                            
                            <?php 
                            echo '</tr>';

                        }

                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                ?>
            </table>
        
    </body>
</html>


