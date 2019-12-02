/*jshint esversion: 6 */
//const locate = document.getElementById("your_location");
const errorOut = document.getElementById("error_List");
const findFood = document.getElementById("my_button");

function getLocation() {
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(accessLocation);
    }else{
        //console.log("error");
        errorOut.appendChild(document.createTextNode("error, could not find your location"));
    }
}

function accessLocation(pos){
    var lat = document.createTextNode("Latitude: "+pos.coords.latitude);
    var long = document.createTextNode("Longitude: "+pos.coords.longitude);
    errorOut.innerHTML="";
    errorOut.appendChild(lat);
    errorOut.appendChild(document.createElement("br"));
    errorOut.appendChild(long);
}

//locate.addEventListener("click", getLocation);
findFood.addEventListener("click",getLocation);