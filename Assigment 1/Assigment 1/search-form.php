<?php
	include('header.php')
?>

		<!--<h2>Search</h2>-->

		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR-KEY&callback=initMap"
	  async defer></script>
		<form>
			<!--<h2><span>another</span> h2</h2>-->
			<!-- input information of the restaurant object -->
			<div class="flex-columns">
					<div id="flex-title" class="title">
						<h2>Restaurant Search Page</h2>
					</div>
					<div class="flex-col"><label for="rest_input">Name of the Restaurant</label></div>
					<div class="flex-col"><input type="text" placeholder="Restaurant" id="rest_input"/></div>
				</div>
				<div class="flex-columns">
					<div class="flex-col"><label for="location_input">Location of the Restaurant</label></div>
					<div class="flex-col"><input type="text" placeholder="Location" id="location_input"/></div>
				</div>
				<div class="flex-columns">
						<div class="flex-col"><label for="rating_input">Star Rating Preference</label></div>
						<div class="flex-col"><select id="rating_input">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select></div>
				</div><!--
				<div class="flex-columns">
					<div class="flex-col"><label for="your_location">Your Current Location</label></div>
					<div class="flex-col"><input type="text" placeholder="Your Location" id="your_location"/></div>
				</div>-->
				<div class="flex-columns">
					<div class="flex-col"><label for="my_button">Search By Your Current Location</label></div>
					<div class="flex-col"><input type="button" id="my_button"/>Search</div>
				</div>
				<div class="flex-columns">
						<div class="flex-col"><a href="results-page.php" class="button">Submit</a></div>
			</div>

			<div class="flex-columns">
					<label id="error_List"></label>
			</div>


			<div class="footer">
				<h1>About Our Team</h1>
				<p>we will put contact information here</p>
			</div>

		</form>
	</body>
</html>
