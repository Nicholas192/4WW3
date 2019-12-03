/*jshint esversion: 6 */
//const locate = document.getElementById("your_location");
const errorOut = document.getElementById("error_List");
const findFood = document.getElementById("my_button");

function getLocation() {
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(accessLocation);
    }
}

function accessLocation(pos){
    var lat = document.createTextNode("Latitude: "+pos.coords.latitude);
    var long = document.createTextNode("Longitude: "+pos.coords.longitude);

    if (pos && pos.coords && pos.coords.latitude && pos.coords.longitude) {
        document.getElementById("coord_lat").value=pos.coords.latitude;
        document.getElementById("coord_long").value=pos.coords.longitude;
    }
    findFood.value = 'Location Acquired';
    findFood.disabled = true;
}

//locate.addEventListener("click", getLocation);
findFood.addEventListener("click",getLocation)
