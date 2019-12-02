<?php 

    define('ENVIRONMENT','development');

    if (ENVIRONMENT == 'development') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    $page = basename($_SERVER['PHP_SELF'],'.php');
     
