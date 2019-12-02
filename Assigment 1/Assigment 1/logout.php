<?php

    require_once('includes/bootstrap.php');

    include('header.php');

    auth_logout();
    header('Location: index.php');
