<?php

    require_once('includes/bootstrap.php');
    if (is_logged_in()) header('Location: index.php');
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
                $errors['name'] = "Valid name is required.";
                break;
        }

        switch(validate_email('email')) {
            case 'required':
            case 'sanitize':
                $passed_validation = false;
                $errors['email'] = "Valid email is required.";
                break;
        }

        switch(validate_pass('password','passconf')) {
            case 'required':
                $passed_validation = false;
                $errors['password'] = "Password is required.";
                break;
            case 'match':
                $passed_validation = false;
                $errors['password'] = "Password must match Password Confirmation";
                break;
            case 'pattern':
                $passed_validation = false;
                $errors['password'] = "Password must have at least 1 uppercase, 1 lowercase, 1 number, and be 8+ characters long.";
                break;
        }

        switch(validate_image('pic_path')) {
            case 'required':
                $passed_validation = false;
                $errors['image'] = "A profile picture is required.";
                break;
            case 'type':
                $passed_validation = false;
                $errors['image'] = "Profile picture must be JPEG or PNG file.";
                break;
            case 'size':
                $passed_validation = false;
                $errors['image'] = "Profile picture file size must be smaller than 20MB";
                break;
        }

        switch(validate_enum('marketing',['YES'])) {
            case 'required':
            case 'value':
                $passed_validation = false;
                $errors['marketing'] = "You must accept email notifications.";
                break;
        }

		// if validation was successful
		if ($passed_validation) {

            $name = preg_replace("/[^A-Za-z0-9]/", '', $_POST['email']).'.'.strtolower(pathinfo(basename($_FILES["pic_path"]["name"]),PATHINFO_EXTENSION));

            try {
                $picture_path = upload_image('users/'.$name, $_FILES["pic_path"]["tmp_name"]);
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }

            if($picture_path) {
            
                // create user
    			$result = create_login($_POST['name'],$_POST['email'],$_POST['password'],$picture_path,$_POST['marketing']);

                if ($result == 'duplicate entry') {
                    $errors['duplicate'] = 'That email address is already in use.';
                    $_POST['email'] = null;
                } else {
    				// success
    				// setting auth cookie
    				auth_set_user($result);
    				header('Location: index.php');
    			} 
            }
		}
	}


	include('header.php');
?>

        <form id="form" method="post" enctype="multipart/form-data">
		<!-- use flex columns for the registration page-->
		<div class="flex-columns">
			<div id="flex-title" class="title">
				<h2>NEW USER Registration Page</h2>
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
			<!-- input the name -->
			<div class="flex-col"><label for="name_input">Name</label></div>
			<div class="flex-col"><input type="text" placeholder="Your Name" id="name_input" name="name" value="<?php echo (!empty($_POST['name'])?$_POST['name']:'') ?>"/></div>
		</div>
		<div class="flex-columns">
			<!-- input the email -->
			<div class="flex-col"><label for="email_input">Email</label></div>
			<div class="flex-col"><input type="email" placeholder="youremail@address.ca" id="email_input" name="email" value="<?php echo (!empty($_POST['email'])?$_POST['email']:'') ?>"/></div>
		</div>
		<div class="flex-columns">
			<!-- input the password -->
			<div class="flex-col"><label for="password_input">Password</label></div>
			<div class="flex-col"><input type="password" placeholder="Password" id="password_input"/ name="password"></div>
		</div>
		<div class="flex-columns">
			<!-- confirm password -->
			<div class="flex-col"><label for="confirm_password">Confirm Password</label></div>
			<div class="flex-col"><input type="password" placeholder="Confirm" id="confirm_password"/ name="passconf"></div>
		</div>
		<div class="flex-columns">
				<!-- let the user upload a profile picture -->
				<!-- verify this using js instead of in html5 like in the object submission page
					this was done to learn other verification methods, and because the assignment
					specifically says to verify using js for this page
				-->
				<div class="flex-col"><label for="image_input">Upload a Profile Picture<br>(jpg or png only)</label></div>
				<div class="flex-col"><input type="file" id="image_input" name="pic_path"></div>
		</div>
		<!--<div class="flex-columns">-->
			<!-- input the users date of birth -->
			<!-- we could use this to remind users they are not old enough to drink alchohol-->
			<!--<div class="flex-col"><label for="dob_input">Date of Birth</label></div>
			<div class="flex-col"><input type="text" placeholder="yyyy/mm/dd" id="dob_input"/></div>
		</div>-->
		<div class="flex-columns">
			<!-- allow email notifications -->
			<div class="flex-col"><label for="allow_notifications">Allow Email Notifications?</label></div>
			<div class="flex-col"><input type="checkbox" id="allow_notifications"  value="YES" name="marketing" <?php echo (!empty($_POST['marketing'])?'checked':'') ?>/>Yes</div>
		</div>

        <div class="flex-columns">
            <div class="flex-col" id="error_List"></div>
        </div>

		<div class="flex-columns">
			<!-- submit button -->
				<!--<div class="flex-col"><a href="index.php" class="button">Submit</a></div>-->
				<div class="flex-col"><label for="register">Submit Registration</label></div>
				<div class="flex-col"><button id="register" type="submit">Register</div>
		</div>
		<div class="flex-columns">
			<!-- login if you already have an account -->
				<div class="flex-col"><label>Already Have an Account?</label></div>
				<div class="flex-col"><a href="login.php" class="button">Login</a></div>
			</div>
			<div class="flex-columns">
					<div class="flex-col"><label id="error_List"></label></div>
			</div>
		</form>



<script type="text/javascript" src="js/registration.js"></script>
<?php include('footer.php'); ?>
