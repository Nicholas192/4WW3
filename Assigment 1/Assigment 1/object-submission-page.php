<?php

    require_once('includes/bootstrap.php');
    if (!is_logged_in()) header('Location: login.php');

    $errors = [];

    // check for form submission
    if (!empty($_POST)) {
        $passed_validation = true;

        // validate
        // if any validation fails, set $passed_validation to false
        switch(validate_text('name')) {
            case 'required':
            case 'sanitize':
                $passed_validation = false;
                $errors['name'] = "A valid restaurant name is required.";
                break;
        }

        switch(validate_text('address')) {
            case 'required':
            case 'sanitize':
                $passed_validation = false;
                $errors['address'] = "A valid restaurant address is required.";
                break;
        }

        switch(validate_phone('phone')) {
            case 'required':
            case 'pattern':
                $passed_validation = false;
                $errors['phone'] = "Valid phone number is required.";
                break;
        }

        switch(validate_coords('lat','long')) {
            case 'required':
            case 'sanitize':
            case 'invalid':
                $passed_validation = false;
                $errors['coords'] = "Valid GPS coordinates are required";
                break;
        }

        switch(validate_image('pic_path')) {
            case 'required':
                $passed_validation = false;
                $errors['pic_path'] = "A restaurant picture is required.";
                break;
            case 'type':
                $passed_validation = false;
                $errors['pic_path'] = "Restaurant picture must be JPEG or PNG file.";
                break;
            case 'size':
                $passed_validation = false;
                $errors['pic_path'] = "Restaurant picture file size must be smaller than 20MB";
                break;
        }

        switch(validate_text('description')) {
            case 'required':
            case 'value':
                $passed_validation = false;
                $errors['description'] = "Please enter a description about the restaurant.";
                break;
        }

        // if validation was successful
        if ($passed_validation) {

            $name = preg_replace("/[^A-Za-z0-9]/", '', $_POST['email']).'.'.strtolower(pathinfo(basename($_FILES["pic_path"]["name"]),PATHINFO_EXTENSION));

            try {
                $picture_path = upload_image('restaurants/'.$name, $_FILES["pic_path"]["tmp_name"]);
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }

            if($picture_path) {
            
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
        <form id="form" method="post" enctype="multipart/form-data" novalidate>

			<!-- this allows the user to create accounts for individual restaurants. -->
			<!-- the format of the submission credentials for restaurants -->
			<div class="flex-columns">
				<div id="flex-title" class="title">
					<h2>Restaurant Submission Page</h2>
				</div>
            </div>
            <div class="flex-columns" style="color: #D00;">
                <?php 
                    foreach ($errors as $error) {
                        echo $error.'<br>';
                    }
                ?>
            </div>
            <div class="flex-columns">
				<div class="flex-col"><label for="rest_name">Name</label></div>
				<div class="flex-col"><input type="text" placeholder="Restaurant Name" id="rest_name" required name="name" value="<?php echo (!empty($_POST['name'])?$_POST['name']:'') ?>"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="address_input">Address</label></div>
				<div class="flex-col"><input type="text" placeholder="Address" id="address_input" required name="address" value="<?php echo (!empty($_POST['address'])?$_POST['address']:'') ?>"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="phone_input">Phone Number</label></div>
				<div class="flex-col"><input type="tel" placeholder="+1 (123)-456-7890" id="phone_input" required name="phone" pattern='+?1?-?\s?(?[0-9]{3})?-?\s?[0-9]{3}-?\s?[0-9]{4}' title='Phone Number (Format: 123-456-7890)' value="<?php echo (!empty($_POST['phone'])?$_POST['phone']:'') ?>"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="latitude_input">Latitude</label></div>
				<div class="flex-col"><input type="text" placeholder="Latitude" id="latitude_input" required name="lat" value="<?php echo (!empty($_POST['lat'])?$_POST['lat']:'') ?>"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="longitude_input">Longitude</label></div>
				<div class="flex-col"><input type="text" placeholder="Longitude" id="longitude_input" required name="long" value="<?php echo (!empty($_POST['long'])?$_POST['long']:'') ?>"/></div>
			</div>
			<div class="flex-columns">
					<div class="flex-col"><label for="image_input">Upload an Image</label></div>
					<div class="flex-col"><input type="file" id="image_input" placeholder="picture" accept="image/*" required name="pic_path"></textarea></div>
			</div>
			<div class="flex-columns">
					<div class="flex-col"><label for="description_input">Description</label></div>
					<div class="flex-col"><textarea id="description_input" placeholder="Description (type of food, etc)" required name="description"><?php echo (!empty($_POST['description'])?$_POST['description']:'') ?></textarea></div>
			</div>
			<div class="flex-columns">
					<!--<div class="flex-col"><a href="results-page.php" class="button">Submit</a></div>-->
					<div class="flex-col"><label for="submit_input">Submit Restaurant</label></div>
					<div class="flex-col"><button id="submit_input" type="submit">Submit</div>
			</div>

<?php include('footer.php'); ?>
