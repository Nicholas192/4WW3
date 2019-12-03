<?php

    require_once('includes/bootstrap.php');

    $restaurants = search_restaurant();

    include('header.php');
?>


<!-- this is an example of the main wrap from the css file. It centers the text and objects in the page. -->

        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GMAPS_API_KEY ?>"></script>
        <script src="js/newmap.js"></script>

		<div class="main-wrap">

            <?php foreach ($restaurants as $index => $restaurant) { ?>
    			<div class="image-container">

                    <div id="map-<?php echo $restaurant['id']?>" style="width:100%;height: 266px;"></div>
                    <script type="text/javascript">
                        i = 0;
                        while(true) {
                            if (google) {
                                initMapSmall(document.getElementById('map-<?php echo $restaurant['id']?>'),'<?php echo $restaurant['name']?>',<?php echo $restaurant['lat']?>,<?php echo $restaurant['long']?>);
                                break;
                            }
                        } 
                    </script>
                    <div style="float:right;" class="rating rate-<?php echo $restaurant['rating']?>">
                        <label class="star-1" for="star-1"></label>
                        <label class="star-2" for="star-2"></label>
                        <label class="star-3" for="star-3"></label>
                        <label class="star-4" for="star-4"></label>
                        <label class="star-5" for="star-5"></label>
                    </div>
    				<a href="individual-object-page.php?id=<?php echo $restaurant['id'] ?>"><h2 class="restaurant-name"><?php echo $restaurant['name'] ?></h2></a>
    			</div>
            <?php } ?>

		</div>

<?php include('footer.php'); ?>
