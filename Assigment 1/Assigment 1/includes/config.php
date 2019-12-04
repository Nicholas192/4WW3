<?php 

    /*
        Simple config to manage the environment
    */



    // Define working envionment
    define('ENVIRONMENT','production');

    // If in development, show error for debugging
    if (ENVIRONMENT == 'development') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    // Get the file name of the page so we can style the website accordingly
    $page = basename($_SERVER['PHP_SELF'],'.php');
     
