<?php

    require_once('includes/bootstrap.php');

    // check for form submission
    if (!empty($_POST)) {
        $passed_validation = true;

        // validate
        // if any validation fails, set $passed_validation to false

        // if validation was successful
        if ($passed_validation) {


            $picture_path = 'images/restaurants/'.preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['name']).'.'.strtolower(pathinfo(basename($_FILES["pic_path"]["name"]),PATHINFO_EXTENSION));

            if (move_uploaded_file($_FILES["pic_path"]["tmp_name"],$picture_path)) {
            
                // create user
                $restaurant_id = create_restaurant($_POST['name'],$_POST['address'],$_POST['phone'],$_POST['lat'],$_POST['long'],$picture_path,$_POST['description']);

                // if user was created
                if($restaurant_id) {
                    // success
                    // setting auth cookie
                    header('Location: individual-object-page.php?id='.$restaurant_id);

                // if failed to create user
                } else {
                    // nothing!
                }
            }
        }
    }

    include('header.php');
?>

		<!--<h2>Restaurant Submission Page</h2>-->

		<!--<div id="map"></div>-->
        <form id="form" method="post" enctype="multipart/form-data">

			<!-- this allows the user to create accounts for individual restaurants. -->
			<!-- the format of the submission credentials for restaurants -->
			<div class="flex-columns">
				<div id="flex-title" class="title">
					<h2>Restaurant Submission Page</h2>
				</div>
				<div class="flex-col"><label for="rest_name">Name</label></div>
				<div class="flex-col"><input type="text" placeholder="Restaurant Name" id="rest_name" required name="name"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="address_input">Address</label></div>
				<div class="flex-col"><input type="text" placeholder="Address" id="address_input" required name="address"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="phone_input">Phone Number</label></div>
				<div class="flex-col"><input type="tel" placeholder="+1 (123)-456-7890" id="phone_input" required name="phone" pattern='+?1?-?\s?(?[0-9]{3})?-?\s?[0-9]{3}-?\s?[0-9]{4}' title='Phone Number (Format: 123-456-7890)'/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="latitude_input">Latitude</label></div>
				<div class="flex-col"><input type="text" placeholder="Latitude" id="latitude_input" required name="lat"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="longitude_input">Longitude</label></div>
				<div class="flex-col"><input type="text" placeholder="Longitude" id="longitude_input" required name="long"/></div>
			</div>
			<div class="flex-columns">
					<div class="flex-col"><label for="image_input">Upload an Image</label></div>
					<div class="flex-col"><input type="file" id="image_input" placeholder="picture" accept="image/*" required name="pic_path"></textarea></div>
			</div>
			<div class="flex-columns">
					<div class="flex-col"><label for="description_input">Description</label></div>
					<div class="flex-col"><textarea id="description_input" placeholder="Description (type of food, etc)" required name="description"></textarea></div>
			</div>
			<div class="flex-columns">
					<!--<div class="flex-col"><a href="results-page.php" class="button">Submit</a></div>-->
					<div class="flex-col"><label for="submit_input">Submit Restaurant</label></div>
					<div class="flex-col"><button id="submit_input" type="submit">Submit</div>
			</div>

<?php include('footer.php'); ?>
