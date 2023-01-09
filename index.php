<?php
include(__DIR__ . '/header.php');
//require(__DIR__ . '/validation.php');
//require(__DIR__ . '/calendar.php');

?>

<main>
    <div>
        <div class="hotelimages">
            <img src="/pictures/pexels-aleksandar-pasaric-hotel-night.jpg">
            <img src="/pictures/pexels-efrain-alonso-hotel-street.jpg">
            <img src="/pictures/pexels-junior-teixeira-640.jpg">
        </div>
        <!-- <div class="hotelimg">
            <img src="/pictures/pexels-efrain-alonso-hotel-street.jpg">
        </div> -->
        <div class="hotelinfo">
            <h2>Our rooms</h2>
            <h3>budget</h3>
            <div class="room-budget">
                <div class="price">
                    $2
                </div>
                <?php echo $calendar1->draw(date('Y-m-d')); ?>
                <img src="" class="budget">


            </div>

            <h3>standard</h3>
            <div class="room-standard">
                <div class="price">
                    $4
                </div>
                <img src="" class="standard">
                <?php echo $calendar2->draw(date('Y-m-d')); ?>




            </div>

            <h3>luxury</h3>
            <div class="room-luxury">
                <div class="price">
                    $6
                </div>
                <?php echo $calendar3->draw(date('Y-m-d')); ?>
                <img src="" class="luxury">

            </div>
        </div>
        <div class="form">
            <h3>Book your room here</h3>
            <form action="index.php" method="POST">
                <label for="name"> Name</label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="transferCode"> Transfer Code</label><br>
                <input type="text" id="transferCode" name="transferCode" required><br>
                <label for="arrivalDate">Arrival Date</label><br>
                <input type="date" min="2023-01-01" max="2023-01-31" id="arrivalDate" name="arrivalDate"><br>
                <label for="departureDate">Departure Date</label><br>
                <input type="date" min="2023-01-01" max="2023-01-31" id="departureDate" name="departureDate"><br>
                <label for="rooms">Rooms</label> <br>

                <select name="rooms" id="rooms" class="form-input">
                    <option value="1">Budget</option>
                    <option value="2">Standard</option>
                    <option value="3">Luxury</option>
                </select> <br>

                <!-- <label for="features">Features</label><br>
        <input type="radio" id="html" name="fav_language" value="HTML">
        <label for="html">HTML</label><br>
        <input type="radio" id="css" name="fav_language" value="CSS">
        <label for="css">CSS</label><br>
        <input type="radio" id="javascript" name="fav_language" value="JavaScript">
        <label for="javascript">JavaScript</label> <br> -->
                <input type="submit" value="Make a reservation">
            </form>
        </div>

        <?php
        validationForm();
        ?>
</main>

</body>
<script src="script.js"></script>


</html>
