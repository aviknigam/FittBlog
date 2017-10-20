<?php

// <!-- Facebook Open Graph Tags -->
echo '
<!-- Facebook Open Graph Tags -->
<meta property="og:title" content="' .$title. '">
<meta property="og:type" content="website">
<meta property="og:url" content="https://fittblog.com/' .$row['postCategory']. '/' .$postSlug. '">
<meta property="og:image" content="' . $social. '" />
<meta property="og:description" content="' .$description. '">
<meta property="article:publisher" content="https://www.facebook.com/pg/FittBlog-2028556034045030" />
<meta property="article:author" content="https://www.facebook.com/pg/FittBlog-2028556034045030" />';

// <!-- Twitter Summary Card -->
echo '
<!-- Twitter Summary Card -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="' .$title. '" />
<meta name="twitter:description" content="' .$description. '"/>
<meta name="twitter:image" content="/assets/images/' . $social. '" />';