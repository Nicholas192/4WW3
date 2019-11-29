<?php
	require_once('includes/security.php');
	require_once('includes/auth.php');
	require_once('includes/database.php');
	include('header.php');
?>

		<div class="main-wrap">
		<h2>Individual Restaurant Details</h2>

		<div id="map"></div>

	  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR-KEY&callback=initMapSmall"
	  async defer></script>

		<!--<img src="images/sample-image.png" alt="Relevant textual alternative to the image"/>-->
		<!-- Lorem text to preview the page length and preview what content will be visualized. -->
		<h3>Description - Turtle Jack's</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<!-- TO make it more user friendly for user to input reviews of the restaurant -->
		<h3>Top Reviews</h3>
		<span style="font-size:100%;color:orange;">&starf;</span>
		<span style="font-size:100%;color:orange;">&starf;</span>
		<span style="font-size:100%;color:orange;">&star;</span>
		<span style="font-size:100%;color:orange;">&star;</span>
		<span style="font-size:100%;color:orange;">&star;</span>
		<span> - Fish 1</span>

		<!-- visual representation of the star and comment interface -->
		<p>My sandwich tastes like a fried boot</p>

		<span style="font-size:100%;color:orange;">&starf;</span>
		<span style="font-size:100%;color:orange;">&star;</span>
		<span style="font-size:100%;color:orange;">&star;</span>
		<span style="font-size:100%;color:orange;">&star;</span>
		<span style="font-size:100%;color:orange;">&star;</span>
		<span> - Fish 2</span>

		<p>My sandwich IS a fried boot</p>

		<h3>Enter a Review</h3>
		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
		<span style="font-size:100%;color:orange;" class="rate">&star;</span>

		<p></p>
		<label for="review_input">Review</label>
		<textarea id="review_input" placeholder="Write a review"></textarea>
		<p></p>

		<a href="results-page.php">back to search results</a>

	</div>
		<div class="footer">
			<h1>About Our Team</h1>
			<p>we will put contact information here</p>
		</div>
	</body>
</html>
