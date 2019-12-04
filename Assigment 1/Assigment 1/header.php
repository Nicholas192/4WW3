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
		<?php 
			if ($page=='login') {echo '<title>Login</title>';} 
			elseif ($page=='logout') {echo '<title>Logout</title>';} 
			elseif ($page=='registration') {echo '<title>Register</title>';}
			elseif ($page=='search-form') {echo '<title>Search Restaurants</title>';} 
			elseif ($page=='object-submission-page') {echo '<title>Submit Restaurant</title>';}
			elseif ($page=='results-page') {echo '<title>Results</title>';} 
			elseif ($page=='individual-object-page') {echo '<title>Object</title>';} 
			else {echo '<title>Restaurant Finder</title>';}
		?>

		<meta name="author" content="Nicholas Migliore, Edward Johnson, David Carrie">
		<meta name="description" content="The Restaurant Finder aims to help people who are hungry to find a
		place to eat that suits their desires. The app will provide users with a map of restaurant locations
		along with a description of what each one serves and a user rating and review system.">

		<!-- links the css file to the html file -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body 
	<?php 
        // changing the background colour based on page
		if ($page=='login') {echo 'style="background: #9186ff;"';} 
		elseif ($page=='registration') {echo 'style="background: #8691ff;"';}
		elseif ($page=='search-form') {echo 'style="background: #86ff91;"';} 
		elseif ($page=='object-submission-page') {echo 'style="background: #91ff86;"';}
		else {echo 'style="background: #ff9186;"';}
	?>
	>
		<div class="main-content" style="background: #ff9186;">
		<div class="header">
			<img class="symbol" style="width:100px;margin-top: -15px;float:left;" src="images/restaurant-finder.png" alt="Relevant textual alternative to the image"/>
			<h1>Restaurant Finder</h1>
		</div>
		<div class="top-navigation">

            <?php 
                // if the user is logged in, show their name and picture
                // toggle the active class depending on which page we're on
            ?>
            <?php if (is_logged_in()) { ?>
                <a style="float:right;" href="#" onclick="return false;">
                    Hi, <?php echo $auth_user['name'] ?>
                    <img src="<?php echo $auth_user['pic_path'] ?>" style="display: inline-block; height: 40px; margin: -15px 0;">
                </a>
            <?php } ?>
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
