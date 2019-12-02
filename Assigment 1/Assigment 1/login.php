<?php

    require_once('includes/bootstrap.php');

    // check for form submission
	if (!empty($_POST)) {
		$passed_validation = true;

		// validate
		// if any validation fails, set $passed_validation to false





		// if validation was successful
		if ($passed_validation) {
			//create user
			$user_id = check_login($_POST['email'],$_POST['password']);

			if($user_id) {
				echo 'success';
				// success
				// setting auth cookie
				auth_set_user($user_id);
				header('Location: index.php');
			} else {
				echo 'failure';
				// failure
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
<?php include('footer.php'); ?>
