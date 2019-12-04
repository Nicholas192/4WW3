<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="X-UA-Compatible" content="ie=edge">
		
		<link rel="icon" href="images/favicon.png">
		<!-- third-generation iPad with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/restaurant-finder.png">
		<!-- iPhone with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/restaurant-finder.png">
		<!-- first- and second-generation iPad: -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/restaurant-finder.png">
		<!-- non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
		<link rel="apple-touch-icon-precomposed" href="images/favicon.png">


		<!--  Below are the names of the tabs, which appear at the top of the browser   -->
		<!--  We might want to include the name of our restaurant in these, especially the homepage    -->
		<!-- also, we should find a way to include the user's search in the search results tab's title and
		also include the name of the restaurant in the individual object page. Add more cases if there is more pages that need them -->
		<?php if ($page=='login') {echo '<title>Login</title>';} elseif ($page=='logout') {echo '<title>Logout</title>';} elseif ($page=='registration') {echo '<title>Register</title>';} 
		elseif ($page=='search-form') {echo '<title>Search Restaurants</title>';} elseif ($page=='object-submission-page') {echo 'Submit Restaurant';}
		elseif ($page=='results-page') {echo '<title></title>'} else {echo '<title>Homepage</title>'?>

		<meta name="author" content="Nicholas Migliore, Edward Johnson, David Carrie">
		<meta name="description" content="The Restaurant Finder aims to help people who are hungry to find a
		place to eat that suits their desires. The app will provide users with a map of restaurant locations
		along with a description of what each one serves and a user rating and review system.">

		<!-- links the css file to the html file -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
	<?php if ($page=='login') {echo '<div class=body-blue>';} elseif ($page=='logout') {echo '<div class=body-blue>';} elseif ($page=='registration') {echo '<div class=body-green>';} 
	elseif ($page=='search-form') {echo '<div class=body-yellow>';} elseif ($page=='object-submission-page') {echo '<div class=body-orange>';}
	else {echo '<div class=body-white>'?>
		<div class="header">
			<h1>Restaurant Finder</h1>
			<img class="symbol" src="images/restaurant-finder.png" alt="Relevant textual alternative to the image"/>
		</div>
		<div class="top-navigation">

			<a <?php if ($page=='index') echo 'class="active"'; ?> id="home" href="index.php">Homepage</a>

			<?php if (is_logged_in()) {?>
				<a <?php if ($page=='object-submission-page') echo 'class="active"'; ?> id="submit" href="object-submission-page.php">Submission</a>
                
			<?php } ?>

			<a <?php if ($page=='search-form') echo 'class="active"'; ?> id="search" href="search-form.php">Search</i></a>

			<?php if (!is_logged_in()) {?>
				<a <?php if ($page=='registration') echo 'class="active"'; ?> id="reg" href="registration.php">Register</a>
			    <a <?php if ($page=='login') echo 'class="active"'; ?> id="login" href="login.php">Login</a>

			<?php } else { ?>
				<a <?php if ($page=='logout') echo 'class="active"'; ?> id="logout" href="logout.php">Logout</a>

			<?php }?>
		</div>

		
