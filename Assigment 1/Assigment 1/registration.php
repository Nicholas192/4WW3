<?php
// load database
	require_once('includes/security.php');
	require_once('includes/auth.php');
	require_once('includes/database.php');

// check for form submission
	if (!empty($_POST)) {
		$passed_validation = true;

		// validate
		// if any validation fails, set $passed_validation to false





		// if validation was successful
		if ($passed_validation) {
			//create user
			$user_id = create_login($_POST['name'],$_POST['email'],$_POST['password'],$_POST['pic_path'],$_POST['marketing'])
			if($user_id) {
				// success
				// setting auth cookie
				auth_set_user($user_id);
				header('Location: index.php');
			} else {
				// failure
			}
		}
	}


	include('header.php');
?>

		<form id="form" method="post">
		<!-- use flex columns for the registration page-->
		<div class="flex-columns">
				<div id="flex-title" class="title">
					<h2>NEW USER Registration Page</h2>
				</div>
				<!-- input the name -->
				<div class="flex-col"><label for="name_input">Name</label></div>
				<div class="flex-col"><input type="text" placeholder="Your Name" id="name_input" name="name"/></div>
			</div>
			<div class="flex-columns">
				<!-- input the email -->
				<div class="flex-col"><label for="email_input">Email</label></div>
				<div class="flex-col"><input type="email" placeholder="youremail@address.ca" id="email_input" name="email"/></div>
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
					<div class="flex-col"><label for="image_input">Upload a Profile Picture (jpg or png only)</label></div>
					<div class="flex-col"><input type="file" id="image_input" required name="pic_path"></div>
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
				<div class="flex-col"><input type="checkbox" id="allow_notifications"  value="YES" name="marketing"/>Yes</div>
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



		<div class="footer">
			<h1>About Our Team</h1>
			<p>we will put contact information here</p>
		</div>
	</body>
</html>
