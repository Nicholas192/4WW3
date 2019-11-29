<?php
	require_once('includes/security.php');
	require_once('includes/auth.php');

  auth_logout();
  header('Location: index.php');
