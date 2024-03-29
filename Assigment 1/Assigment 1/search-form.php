<?php
    // Include bootstrap
    require_once('includes/bootstrap.php');

    // If they submitted the seach
    if (!empty($_POST)) {

        // init search data array
        $search_data = [];

        // if they submitted name ...
        if (!empty($_POST['name'])) {
            // ... validate and sanitize ...
            switch(validate_text('name')) {
                // ... add to array only if ok.
                case 'ok': $search_data['name'] = $_POST['name']; break;
                // if it didn't come back as ok, then there was something wrong or malicious... remove it from the form
                default: $_POST['name'] = null;
            }
        }

        // if they submitted location ...
        if (!empty($_POST['location'])) {
            // ... validate and sanitize ...
            switch(validate_text('location')) {
                // ... add to array only if ok.
                case 'ok': $search_data['address'] = $_POST['location']; break;
                // if it didn't come back as ok, then there was something wrong or malicious... remove it from the form
                default: $_POST['location'] = null;
            }
        } 

        // if they submitted rating ...
        if (!empty($_POST['rating'])) {
            // ... validate and sanitize ...
            switch(validate_int('rating')) {
                // ... add to array only if ok.
                case 'ok': $search_data['rating'] = $_POST['rating']; break;
                // if it didn't come back as ok, then there was something wrong or malicious... remove it from the form
                default: $_POST['rating'] = null;
            }
        }
         
        // if they submitted coords ...
        if (!empty($_POST['coord_lat']) && !empty($_POST['coord_long'])) {
            // ... validate and sanitize ...
            switch(validate_text('name')) {
                // ... add to array only if ok.
                case 'ok': 
                    $search_data['lat'] = $_POST['coord_lat'];
                    $search_data['long'] = $_POST['coord_long']; 
                    break;
                // if it didn't come back as ok, then there was something wrong or malicious... remove it from the form
                default: 
                    $_POST['coord_lat'] = null;
                    $_POST['coord_long'] = null;

            }
        }

        // If there's data in the $search_data
        if (!empty($search_data))
            // Execute the search
            $restaurants = advanced_search_restaurant($search_data);



    }

    // Include the html header
    include('header.php');
?>


		<!--<h2>Search</h2>-->

		<form method="post">
			<!--<h2><span>another</span> h2</h2>-->
			<!-- input information of the restaurant object -->
			<div class="flex-columns">
					<div id="flex-title" class="title">
						<h2>Restaurant Search Page</h2>
					</div>
					<div class="flex-col"><label for="rest_input">Name of the Restaurant</label></div>
					<div class="flex-col"><input type="text" placeholder="Restaurant" id="rest_input" value="<?php echo (!empty($_POST['name'])?$_POST['name']:'') ?>" name="name"/></div>
				</div>
				<div class="flex-columns">
					<div class="flex-col"><label for="location_input">Location of the Restaurant</label></div>
					<div class="flex-col"><input type="text" placeholder="Location" id="location_input" value="<?php echo (!empty($_POST['location'])?$_POST['location']:'') ?>" name="location"/></div>
				</div>
				<div class="flex-columns">
						<div class="flex-col"><label for="rating_input">Star Rating Preference</label></div>
						<div class="flex-col"><select id="rating_input" name="rating">
                            <option value="0">Any</option>
							<option <?php echo (!empty($_POST['rating']) && $_POST['rating'] == 1?'selected':'') ?> value="1">1</option>
							<option <?php echo (!empty($_POST['rating']) && $_POST['rating'] == 2?'selected':'') ?> value="2">2</option>
							<option <?php echo (!empty($_POST['rating']) && $_POST['rating'] == 3?'selected':'') ?> value="3">3</option>
							<option <?php echo (!empty($_POST['rating']) && $_POST['rating'] == 4?'selected':'') ?> value="4">4</option>
							<option <?php echo (!empty($_POST['rating']) && $_POST['rating'] == 5?'selected':'') ?> value="5">5</option>
						</select></div>
				</div><!--
				<div class="flex-columns">
					<div class="flex-col"><label for="your_location">Your Current Location</label></div>
					<div class="flex-col"><input type="text" placeholder="Your Location" id="your_location"/></div>
				</div>-->
				<div class="flex-columns">
					<div class="flex-col"><label for="my_button">Search By Your Current Location (within 15km)</label></div>
					<div class="flex-col"><input type="button" id="my_button" <?php echo (empty($_POST['coord_lat']) && empty($_POST['coord_long'])?'value="Get Current Location"':'value="Location Acquired" disabled') ?>/></div>
                    <input type="hidden" name="coord_lat" id="coord_lat" value="<?php echo (!empty($_POST['coord_lat'])?$_POST['coord_lat']:'') ?>">
                    <input type="hidden" name="coord_long" id="coord_long" value="<?php echo (!empty($_POST['coord_long'])?$_POST['coord_long']:'') ?>">
				</div>
				<div class="flex-columns">
						<div class="flex-col"><input type="submit" class="button" value="Search"/></div>
			</div>

			<div class="flex-columns">
					<label id="error_List"></label>
			</div>
</form>
<script src="js/search.js"></script>

<!-- this is an example of the main wrap from the css file. It centers the text and objects in the page. -->
        
        <?php if (!empty($restaurants)) { // If there are restaurants to display, show them?>
            <hr>

            <h2>Search Results</h2>
            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GMAPS_API_KEY ?>"></script>
            <script src="js/newmap.js"></script>

            <div class="main-wrap">

                <?php foreach ($restaurants as $index => $restaurant) {  // looping though restaurants?>
                    <div class="image-container">

      <!--                  <img src="<?php echo $restaurant['pic_path'] ?>"> -->
 <div class="restaurant-image" style="background-image: url('<?php echo $restaurant['pic_path'] ?>');"></div>

                        <div style="float:right;" class="rating rate-<?php echo $restaurant['rating']?>">
                            <label class="star-1" for="star-1"></label>
                            <label class="star-2" for="star-2"></label>
                            <label class="star-3" for="star-3"></label>
                            <label class="star-4" for="star-4"></label>
                            <label class="star-5" for="star-5"></label>
                        </div>
                        <a href="individual-object-page.php?id=<?php echo $restaurant['id'] ?>"><h2 class="restaurant-name"><?php echo $restaurant['name'] ?></h2></a>
		    </div>
<br><br><br>
                <?php } ?>

            </div>
        <?php } ?>


<?php include('footer.php'); // Include the html footer?>
