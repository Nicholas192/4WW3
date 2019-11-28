<?php
	include('header.php')
?>

		<!-- Login credential interface -->
		<div class="flex-columns">
				<div id="flex-title" class="title">
					<h2>Login</h2>
				</div>
				<!-- email credentials -->
				<div class="flex-col"><label for="email_input">Email</label></div>
				<div class="flex-col"><input type="text" placeholder="youremail@address.ca" id="email_input"/></div>
			</div>
			<!-- password input and interface -->
			<div class="flex-columns">
				<div class="flex-col"><label for="password_input">Password</label></div>
				<div class="flex-col"><input type="password" placeholder="Password" id="password_input"/></div>
			</div>
			<!-- sumbit button centered -->
			<div class="flex-columns">
					<div class="flex-col"><a href="index.php" class="button">Submit</a></div>
			</div>
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
