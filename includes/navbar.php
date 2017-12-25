<div class="navbar" itemscope itemtype="http://schema.org/WPHeader">
    <div class="masthead flex">
        <span><i class="fas fa-caret-right fa-2x"></i></span>
        <span class="date">
            <?php
            date_default_timezone_set('Australia/Sydney');
            echo date('jS F Y', strtotime("now")); 
            ?>
        </span>
    </div>
    <div class="nav-logo flex">
        <a href="/">
            <img src="/assets/images/logo.png" alt="FITTBLOG">
        </a>
    </div>
</div>