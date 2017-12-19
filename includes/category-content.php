<?php
// $stmt = $conn->query("SELECT * FROM posts WHERE postCategory = '$category' ORDER BY postID desc");
// while($row = $stmt->fetch_assoc()) {
//     echo "$row[postTitle] <br />";
// }

// REMEMBER TO PUT HEADER SOCIALS?

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FittBlog | Coming Soon</title>

    <style>
            /* Set height to 100% for body and html to enable the background image to cover the whole page: */
            body, html {
                height: 100%;
                margin: 0px;
                padding: 0px;
            }

            .bgimg {
                /* Background image */
                background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
                /* Full-screen */
                height: 100%;
                /* Center the background image */
                background-position: center;
                /* Scale and zoom in the image */
                background-size: cover;
                /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
                position: relative;
                /* Add a white text color to all elements inside the .bgimg container */
                color: white;
                /* Add a font */
                font-family: "Courier New", Courier, monospace;
                /* Set the font-size to 25 pixels */
                font-size: 25px;
            }

            /* Position text in the top-left corner */
            .topleft {
                position: absolute;
                top: 0;
                left: 16px;
            }

            /* Position text in the bottom-left corner */
            .bottomleft {
                position: absolute;
                bottom: 0;
                left: 16px;
            }

            /* Position text in the middle */
            .middle {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }

            /* Style the <hr> element */
            hr {
                margin: auto;
                width: 40%;
            }
    </style>
</head>
<body>
<div class="bgimg">
  <div class="topleft">
    <p>FittBlog</p>
  </div>
  <div class="middle">
    <h1>Coming Soon</h1>
    <hr>
  </div>
  <div class="bottomleft">
    <p><a style="text-decoration: underline; color: white;" href="https://instagram.com/aviknigam">Click here and follow me for updates!</a></p>
  </div>
</div>
</body>
</html>