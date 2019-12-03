function displayStars(stars) {
    var element = document.getElementById("review_rating");
    for (var i = 5; i > 0; i--) {
        element.classList.remove("rate-"+i);
    }
    
    element.classList.add("rate-"+stars);
}
