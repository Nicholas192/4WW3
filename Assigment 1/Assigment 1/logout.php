<?php

    // Inlude bootstrap
    require_once('includes/bootstrap.php');

    // Logout the user
    auth_logout();

    // Send them to the homepage
    header('Location: index.php');
