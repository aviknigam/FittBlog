<?php

// <!-- Facebook Open Graph Tags -->
echo '
<!-- Facebook Open Graph Tags -->
<meta property="og:title" content="' .$title. '">
<meta property="og:type" content="website">
<meta property="og:url" content="https://www.fittblog.com">
<meta property="og:image" content="/assets/images/logo.png">
<meta property="og:description" content="' .$description. '">';

// <!-- Twitter Summary Card -->
echo '
<!-- Twitter Summary Card -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="' .$title. '" />
<meta name="twitter:description" content="' .$description. '"/>
<meta name="twitter:image" content="android-chrome-256x256.jpg" />';

