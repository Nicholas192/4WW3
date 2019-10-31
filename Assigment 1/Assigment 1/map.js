var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		//center: {lat: latitude, lng: longitude},
		center: {lat: 18.517768, lng: 73.843918},
		zoom: 20
	});
}