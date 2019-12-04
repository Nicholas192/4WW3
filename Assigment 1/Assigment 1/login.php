<?php

    // Inlude bootstrap
    require_once('includes/bootstrap.php');

    // initalize variables
    $errors = [];

    // check for form submission
	if (!empty($_POST)) {
		$passed_validation = true;

        // Ensure the email is there
        switch(validate_email('email')) {
            case 'required':
            case 'sanitize':
                $passed_validation = false;
                $errors['email'] = "Email is required.";
                break;
        }

        // Just checking for password being required. Not maipulation with trim or sanitize
        switch(validate_text('password',true,false,false)) {
            case 'required':
                $passed_validation = false;
                $errors['password'] = "Password is required.";
                break;
        }

		// if validation was successful
		if ($passed_validation) {

			//check user creds
			$user_id = check_login($_POST['email'],$_POST['password']);

            // if we got an id back
			if($user_id) {
				
				// setting auth cookie
				auth_set_user($user_id);

                // Redirect to header
				header('Location: index.php');
                exit();
			} else {
                $errors['auth'] = "That username and password combination don't match. Please try again";
			}
		}
	}

	include('header.php');
?>
<form id="form" method="post">

    <!-- Login credential interface -->
    <div class="flex-columns">
		<div id="flex-title" class="title">
			<h2>Login</h2>
		</div>
    </div>
    <div class="flex-columns" style="color: #D00;">
        <?php 
            // show any errors
            foreach ($errors as $error) {
                echo $error.'<br>';
            }
        ?>
    </div>
    <div class="flex-columns">
		<!-- email credentials -->
		<div class="flex-col"><label for="email_input">Email</label></div>
		<div class="flex-col"><input type="text" placeholder="youremail@address.ca" id="email_input" name="email"/></div>
	</div>
	<!-- password input and interface -->
	<div class="flex-columns">
		<div class="flex-col"><label for="password_input">Password</label></div>
		<div class="flex-col"><input type="password" placeholder="Password" id="password_input" name="password"/></div>
	</div>
    <div class="flex-columns">
        <div class="flex-col" id="error_List"></div>
    </div>
	<!-- sumbit button centered -->
	<div class="flex-columns">
			<div class="flex-col"><input type="submit" class="button" value="Login"></div>
	</div>

</form>

<!-- user can create an sccount -->
<div class="flex-columns">
		<div class="flex-col"><label>Don't Have an Account?</label></div>
		<div class="flex-col"><a href="registration.php" class="button">Register</a></div>
</div>



<script type="text/javascript" src="js/login.js"></script>
<?php include('footer.php'); // Load the html footer?>
