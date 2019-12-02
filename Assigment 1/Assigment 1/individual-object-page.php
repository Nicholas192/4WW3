<?php

    require_once('includes/bootstrap.php');

    if (empty($_GET['id'])) header('Location: search-form.php');

    $restaurant = search_restaurant(intval($_GET['id']));

    include('header.php');
?>

		<div class="main-wrap">
		<h2>Individual Restaurant Details</h2>

		<div id="map"></div>
        <script src="js/newmap.js"></script>
        <script type="text/javascript">
            function loadmap() {
                initMapSmall(document.getElementById('map'),'<?php echo $restaurant['name']?>',<?php echo $restaurant['lat']?>,<?php echo $restaurant['long']?>)
            }
        </script>
	    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GMAPS_API_KEY ?>&callback=loadmap" async defer></script>

		<!--<img src="images/sample-image.png" alt="Relevant textual alternative to the image"/>-->
		<!-- Lorem text to preview the page length and preview what content will be visualized. -->
		<h3><?php echo $restaurant['name'] ?></h3>
        <p><?php echo str_replace("\n\n", "</p><p>", $restaurant['description'])?></p>



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

        <?php if (is_logged_in()) { ?>
            <form method="post">
        		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
        		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
        		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
        		<span style="font-size:100%;color:orange;" class="rate">&star;</span>
        		<span style="font-size:100%;color:orange;" class="rate">&star;</span>

        		<p></p>
        		<label for="review_input">Review</label>
        		<textarea id="review_input" placeholder="Write a review"></textarea>
        		<p></p>
            </form>
        <?php } else { ?>
            <p>
            <label for="review_input">To leave a review, please <a href="login.php">login</a></label>
            </p>
        <?php } ?>

		<a href="results-page.php">back to search results</a>

	</div>



<?php include('footer.php'); ?>
