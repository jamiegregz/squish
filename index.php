<?php
    // TODO: Remove this
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require(__DIR__ . "/lib/Squisher.class.php");

    $squisher = null;

    if(isset($_POST['url'])) {
        $url = $_POST['url'];

        // Do the stuff to squish & add the URL to the DB
        $squisher = new Squisher();
        $squisher->squish($url);

        // Make the long and squished URL available as vars to pickup in the template.
        $squished_url = $squisher->get_squished_url();
        $long_url = $squisher->get_long_url();
    }

    include(__DIR__ . "/inc/home.inc.php");
