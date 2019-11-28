<?php
	include('header.php')
?>



		<h2>Search Results Page</h2>

		<div id="map"></div>
		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR-KEY&callback=initMapBig"
	  	async defer></script>


		<!--Begin using flex grid for the search results. divide it into 3 tabs-->
		<div class="flex-grid-thirds">
			<!--this tab contains to page information-->
			<!-- TODO: try to make this tab look better without ruining the other tabs-->
			<div class="colSearch">
				<td>Location you searched:</td>
				<td>Upper James St.</td>
			</div>
			<div class="col">
				<!--here is where the restaurant information is stored. also acts as a link to the individual object-->
					<a class="flex-grid-thirds" href="individual-object-page.php">
							<table class="resultTable">
							<tr class="col">
								<td>Name: </td>
								<td>Turtle Jack's</td>
								<!--lat 43.216936 lon -79.887433-->
							</tr>
							<tr class="col">
								<td>Address:</td>
								<td>1180 Upper James St, Hamilton, ON L9C 3B1</td>
							</tr>
							<tr class="col">
								<td>Description:</td>
								<td>All sorts of food to eat here!</td>
							</tr>
							<tr class="col">
								<td>Rating:</td>
								<td>4.0/5 stars</td>
							</tr>
							</table>
						</a>
			</div>
			<div class="colImg">
				<!--stores the picture of the object -->
				<td><img class="picture" src="images/TJs.png" alt="Relevant textual alternative to the image"/></td>
			</div>
		</div>


		<div class="flex-grid-thirds">
			<div class="colSearch">
				<td>Location you searched:</td>
				<td>Upper James St.</td>
			</div>
			<div class="col">
					<a class="flex-grid-thirds" href="individual-object-page.php">
							<table class="resultTable">
								<tr class="col">
									<td>Name: </td>
									<td>The Keg Steakhouse + Bar - Hamilton Mountain</td>
									<!--lat 43.218760, -79.887384-->
								</tr>
								<tr class="col">
									<td>Address:</td>
									<td>1170 Upper James St, Hamilton, ON L9C 3B1</td>
								</tr>
								<tr class="col">
									<td>Description:</td>
									<td>Aged beef, shellfish & happy-hour specials are the mainstays at this clubby yet casual chain.</td>
								</tr>
								<tr class="col">
									<td>Rating:</td>
									<td>4.5/5 stars</td>
								</tr>
							</table>
						</a>
			</div>
			<div class="colImg">
				<td><img class="picture" src="images/ks.jpg" alt="Relevant textual alternative to the image"/></td>
			</div>
		</div>

		<div class="flex-grid-thirds">
				<div class="colSearch">
					<td>Location you searched:</td>
					<td>Upper James St.</td>
				</div>
				<div class="col">
						<a class="flex-grid-thirds" href="individual-object-page.php">
								<table class="resultTable">
									<tr class="col">
										<td>Name: </td>
										<td>Domino's Pizza</td>
										<!--lat 43.216751 lon -79.886109-->
									</tr>
									<tr class="col">
										<td>Address:</td>
										<td>1171 Upper James St Unit #10, Hamilton, ON L9C 3B2</td>
									</tr>
									<tr class="col">
										<td>Description:</td>
										<td>Delivery/carryout chain offering a wide range of pizza, plus chicken & other sides.</td>
									</tr>
									<tr class="col">
										<td>Rating:</td>
										<td>3.7/5 stars</td>
									</tr>
								</table>
							</a>
				</div>
				<div class="colImg">
					<td><img class="picture" src="images/DPs.png" alt="Relevant textual alternative to the image"/></td>
				</div>
			</div>


			<div class="flex-grid-thirds">
					<div class="colSearch">
						<td>Location you searched:</td>
						<td>Upper James St.</td>
					</div>
					<div class="col">
							<a class="flex-grid-thirds" href="individual-object-page.php">
									<table class="resultTable">
										<tr class="col">
											<td>Name: </td>
											<td>Shoeless Joe's Sports Grill</td>
											<!--lat 43.216313 lon -79.886458-->
										</tr>
										<tr class="col">
											<td>Address:</td>
											<td>1183 Upper James St, Hamilton, ON L9C 3B2</td>
										</tr>
										<tr class="col">
											<td>Description:</td>
											<td>Late-night food. Outdoor seating. Great cocktails</td>
										</tr>
										<tr class="col">
											<td>Rating:</td>
											<td>4.2/5 stars</td>
										</tr>
									</table>
								</a>
					</div>
					<div class="colImg">
						<td><img class="picture" src="images/SJs.jpg" alt="Relevant textual alternative to the image"/></td>
					</div>
				</div>

		<!-- the information in the footer of the webpage -->
		<div class="footer">
			<h1>About Our Team</h1>
			<p>we will put contact information here</p>
		</div>

	</body>
</html>
