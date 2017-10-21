<?php require __DIR__ . '/../core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sitemap Generator</title>
</head>
<body>
<pre>
<?php 
    echo htmlspecialchars('
    <?xml version="1.0" encoding="UTF-8"?>
    <urlset
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">');  

    echo htmlspecialchars('
    <url>
        <loc>https://fittblog.com/</loc>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>');

    echo '<br/>';

    $sql = $conn->query('SELECT * FROM posts ORDER BY postID desc');
    while($row = $sql->fetch_assoc()) {
    echo htmlspecialchars('    <url>
        <loc>https://fittblog.com/' .$row['postCategory']. '/' .$row['postSlug']. '</loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>'
    );

    echo '<br/>';
    }

    echo htmlspecialchars('    </urlset>');

?>
</pre>

</body>
</html>