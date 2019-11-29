<?php
// load database
	require_once('includes/security.php');
	require_once('includes/auth.php');
	require_once('includes/database.php');
echo 'userid '.auth_get_user_id();
// check for form submission
	if (!empty($_POST)) {
		$passed_validation = true;

		// validate
		// if any validation fails, set $passed_validation to false





		// if validation was successful
		if ($passed_validation) {
			//create user
			$user_id = check_login($_POST['email'],$_POST['password']);
			var_dump($user_id);
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

<form method="post">

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
			<!-- sumbit button centered -->
			<div class="flex-columns">
					<div class="flex-col"><input type="submit" class="button">Submit</a></div>
			</div>

		</form>

			<!-- user can create an sccount -->
			<div class="flex-columns">
					<div class="flex-col"><label>Don't Have an Account?</label></div>
					<div class="flex-col"><a href="registration.php" class="button">Register</a></div>
		</div>

		<div class="footer">
			<h1>About Our Team</h1>
			<p>we will put contact information here</p>
		</div>
	</body>
</html>
