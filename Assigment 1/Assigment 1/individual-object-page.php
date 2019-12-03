<?php

    require_once('includes/bootstrap.php');

    // if (!is_logged_in()) header('Location: login.php');
    if (empty($_GET['id'])) header('Location: search-form.php');
    $errors = [];
    $_GET['id'] = intval($_GET['id']);

    if (!empty($_POST) && !empty($_GET['id'])) {

        $passed_validation = true;

        switch(validate_int('rating')) {
            case 'required':
            case 'sanitize':
                $passed_validation = false;
                $errors['rating'] = "Please rate your experience.";
                break;
        }

        switch(validate_text('review')) {
            case 'required':
            case 'sanitize':
                $passed_validation = false;
                $errors['review'] = "Tell us about your experience.";
                break;
        }

        if ($passed_validation) {
            save_rating($_GET['id'],$_POST['rating'],$_POST['review']);
            update_restaurant_rating($_GET['id']);
        }
    }

    $restaurant = search_restaurant($_GET['id']);
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
        <div class="rating rate-<?php echo $restaurant['rating']?>">
            <label class="star-1" for="star-1"></label>
            <label class="star-2" for="star-2"></label>
            <label class="star-3" for="star-3"></label>
            <label class="star-4" for="star-4"></label>
            <label class="star-5" for="star-5"></label>
        </div>
        <p><?php echo str_replace("\n\n", "</p><p>", $restaurant['description'])?></p>

        <hr>
        <h3>Top Reviews</h3>

        <?php foreach ($restaurant['reviews'] as $review) { ?>

            <hr style="width:66%">

            <div class="rating rate-<?php echo $review['rating']?>">
                <label class="star-1" for="star-1"></label>
                <label class="star-2" for="star-2"></label>
                <label class="star-3" for="star-3"></label>
                <label class="star-4" for="star-4"></label>
                <label class="star-5" for="star-5"></label>
            </div>
            <p><?php echo $review['review']?></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?php echo $review['name']?></p>
        <?php } ?>


            <hr>
		<h3>Enter a Review</h3>

        <?php if (is_logged_in()) { ?>
        <div class="flex-columns" style="color: #D00;">
            <?php 
                foreach ($errors as $error) {
                    echo $error.'<br>';
                }
            ?>
        </div>
            <form method="post">
                <script type="text/javascript" src="js/review.js"></script>

                <label for="review_input">Rating</label><br>

                <div id="review_rating" class="rating">
            		<label class="star-1" for="star-1"></label><input type="radio" name="rating" id="star-1" value="1" onchange="displayStars(1)">
            		<label class="star-2" for="star-2"></label><input type="radio" name="rating" id="star-2" value="2" onchange="displayStars(2)">
            		<label class="star-3" for="star-3"></label><input type="radio" name="rating" id="star-3" value="3" onchange="displayStars(3)">
            		<label class="star-4" for="star-4"></label><input type="radio" name="rating" id="star-4" value="4" onchange="displayStars(4)">
            		<label class="star-5" for="star-5"></label><input type="radio" name="rating" id="star-5" value="5" onchange="displayStars(5)">
                </div>
                <?php if (!empty($_POST['rating'])) { ?>
                    <script type="text/javascript">
                        displayStars(<?php echo $_POST['rating'] ?>);
                    </script>
                <?php } ?>

        		<p></p>
        		<label for="review_input">Review</label><br>
        		<textarea id="review_input" placeholder="Write a review" name="review"><?php echo (!empty($_POST['review'])?$_POST['review']:'') ?></textarea>
                <input type="submit" value="Submit My Review">
        		<p></p>

            </form>
        <?php } else { ?>
            <p>
            <label for="review_input">To leave a review, please <a href="login.php">login</a></label>
            </p>
        <?php } ?>

	</div>



<?php include('footer.php'); ?>
