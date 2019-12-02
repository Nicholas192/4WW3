<?php

    require_once('includes/bootstrap.php');

    include('header.php');
    include('footer.php');
// i added the footer because i changed the header to include a div opening, which gives a background colour for the entire page
// the end of the div is in the footer so should i include footer.php here?
    auth_logout();
    header('Location: index.php');
