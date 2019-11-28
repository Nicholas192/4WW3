<?php
	include('header.php')
?>

		<!--<h2>Restaurant Submission Page</h2>-->

		<!--<div id="map"></div>-->
    <script>
	  	var map;
	  	const form = document.getElementById('form');
		const latitude = document.getElementById('latitude_input');
		const longitude = document.getElementById('longitude_input');
      	function initMap() {
        	map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: latitude, lng: longitude},
				//center: {lat: -34.397, lng: 150.644},
          		zoom: 8
        	});
      	}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR-KEY&callback=initMap"
    async defer></script>
		<form>

			<!-- this allows the user to create accounts for individual restaurants. -->
			<!-- the format of the submission credentials for restaurants -->
			<div class="flex-columns">
				<div id="flex-title" class="title">
					<h2>Restaurant Submission Page</h2>
				</div>
				<div class="flex-col"><label for="rest_name">Name</label></div>
				<div class="flex-col"><input type="text" placeholder="Restaurant Name" id="rest_name" required name="Name"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="address_input">Address</label></div>
				<div class="flex-col"><input type="text" placeholder="Address" id="address_input" required name="Address"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="phone_input">Phone Number</label></div>
				<div class="flex-col"><input type="tel" placeholder="+1 (123)-456-7890" id="phone_input" required name="Phone_Number" pattern='+?1?-?\s?(?[0-9]{3})?-?\s?[0-9]{3}-?\s?[0-9]{4}' title='Phone Number (Format: 123-456-7890)'/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="latitude_input">Latitude</label></div>
				<div class="flex-col"><input type="number" placeholder="Latitude" id="latitude_input" required name="Latitude"/></div>
			</div>
			<div class="flex-columns">
				<div class="flex-col"><label for="longitude_input">Longitude</label></div>
				<div class="flex-col"><input type="number" placeholder="Longitude" id="longitude_input" required name="Longitude"/></div>
			</div>
			<div class="flex-columns">
					<div class="flex-col"><label for="image_input">Upload an Image</label></div>
					<div class="flex-col"><input type="file" id="image_input" placeholder="picture" accept="image/*" required name="Image"></textarea></div>
			</div>
			<div class="flex-columns">
					<div class="flex-col"><label for="description_input">Description</label></div>
					<div class="flex-col"><textarea id="description_input" placeholder="Description (type of food, etc)" required name="Description"></textarea></div>
			</div>
			<div class="flex-columns">
					<!--<div class="flex-col"><a href="results-page.php" class="button">Submit</a></div>-->
					<div class="flex-col"><label for="submit_input">Submit Restaurant</label></div>
					<div class="flex-col"><button id="submit_input" type="submit">Submit</div>
			</div>



			<div class="footer">
				<h1>About Our Team</h1>
				<p>we will put contact information here</p>
			</div>
		</form>
	</body>
</html>
