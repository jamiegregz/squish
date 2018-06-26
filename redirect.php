<?php
    // TODO: Remove this
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require(__DIR__ . "/lib/Squisher.class.php");

    $short_id = $_GET["q"];

    $squisher = new Squisher();

    if($squisher->find_from_id($short_id)) { // Squished URL is valid
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: {$squisher->get_long_url()}");
    } else {
        header("HTTP/1.1 307 Temporary Redirect");
        header("Location: http://{$_SERVER['HTTP_HOST']}");
    }
