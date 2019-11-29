<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Homepage Restaurant Site</title>

		<!-- links the css file to the html file -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
			<div class="top-navigation">
					<a id="home" href="index.php">Homepage</a>
					<?php if (is_logged_in()) {?>
						<a id="submit" href="object-submission-page.php">Submission</a>
					<?php } ?>
					<a id="search" href="search-form.php">Search</i></a>
					<?php if (!is_logged_in()) {?>
						<a id="reg" href="registration.php">Register</a>
					<a id="login" href="login.php">Login</a>
				<?php } else { ?>
					<a id="logout" href="logout.php">Logout</a>

				<?php }?>
				  </div>

		<div class="header">
			<!--<h1>Restaurant Site</h1>
			<p>a short description of the site...</p>

			<div class="flex-columns">
					<div class="flex-col"><a href="index.php" class="current">Homepage</a></div>
					<div class="flex-col"><a href="object-submission-page.php">Submission</a></div>
					<div class="flex-col"><a href="search-form.php">Search</a></div>
				</div>

			<div class="header-login">
				<a href="registration.php">Register</a>
				<a href="login.php">Login</a>
			</div>-->

		</div>
