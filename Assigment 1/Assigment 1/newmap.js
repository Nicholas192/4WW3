var map;
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';//these are the labels for the markers
var infowindow;
var markers = [
    ["Turtle Jack's", 43.216849, -79.887482, '<div id="content">'+
    '<div id="mapNotice">'+
    '</div>'+
    '<h1 id="headone">' + 'Turtle Jacks' + '<h1>' +
    '<div id="bodyc">'+
    '<p> All sorts of food to eat here! </p>' +
    '<p> For more information, click <a href="individual-object-page.php">here</a>' + '</p>'+
    '</div>' + '</div>'],
    ["The Keg Stakehouse + Bar", 43.217162, -79.887279, '<div id="content">'+
    '<div id="mapNotice">'+
    '</div>'+
    '<h1 id="headone">' + 'The Keg Stakehouse + Bar' + '<h1>' +
    '<div id="bodyc">'+
    '<p> Aged beef, shellfish & happy-hour specials are the mainstays at this clubby yet casual chain. </p>' +
    '<p> For more information, click <a href="individual-object-page.php">here</a>' + '</p>'+
    '</div>' + '</div>'],
    ["Domino's Pizza", 43.216711, -79.886102, "Domino's Pizza"],
    ["Shoeless Joe's Sports Grill", 43.216229, -79.886496, "Shoeless Joe's Sports Grill"]
    
]
/*markers[n][m] where 
n is the restaurant we are making a marker for
m is the name [1] the latitude and longitue [2] and [3] and [4] is the text that will appear when the user clicks on the marker
*/

//this map is used for the results page
//make as many restaurants into markers as reasonably possible
function initMapBig(){
    infowindow = new google.maps.InfoWindow();
    map=new google.maps.Map(document.getElementById('map'),{
        center: {lat: 43.216849, lng: -79.887482},
        zoom: 18
    });

    //Add a label for each marker that will be on the map
    for (var n = 0; n < markers.length; n++ ){
        var marker = new google.maps.Marker({
            position: {lat: markers[n][1], lng: markers[n][2]},
            map: map,
            title: markers[n][0],
            label: labels[n],
            zIndex: markers.length - n,
            url: markers[n][3]//add the url to the marker, this appears when the user clicks on it
            
        });
        
        //when the marker is clicked on, the html style text will pop up
        //the html we have in the results page already has that information though
        //maybe we do not need this?
        marker.addListener('click', (function(marker,n){
            return function(){
                infowindow.setContent(markers[n][3]);
                infowindow.open(map, marker);
            }
        })(marker,n));

    }

}

//use this map function in the individual object page
//only has the individual restaurant as the marker
function initMapSmall(){
    //make the map and set it's position
    map=new google.maps.Map(document.getElementById('map'),{
        center: {lat: 43.216849, lng: -79.887482},
        
        zoom: 18
    });

    //add one marker for the individual marker
    var marker = new google.maps.Marker({
        position: {lat: markers[0][1], lng: markers[0][2]},
        map: map,
        title: markers[0][0]
    });

    //marker.setMap(map);
}