<?php
include_once(__DIR__ . '/calendar.php');
require(__DIR__ . '/dbconnection.php');
require(__DIR__ . '/apiconnection.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>budget</h1>
        <?php echo $calendar->draw(date('2023-01-01')) ?>
    </div>
    <div>
        <h1>standard</h1>
        <?php echo $calendar->draw(date('2023-01-01')) ?>
    </div>
    <div>
        <h1>luxury</h1>
        <?php echo $calendar->draw(date('2023-01-01')) ?>
    </div>

    <form action="index.php" method="POST">
        <label for="name"> Name</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="transferCode"> Transfer Code</label><br>
        <input type="text" id="transferCode" name="transferCode"><br>
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

    <?php
    checkAvailability();
    ?>

</body>



</html>