<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';
// require __DIR__ . '/totalcost.php';
// require __DIR__ . '/checktransfercode.php';
require __DIR__ . '/functions.php';



// $statement = $db->query('SELECT * FROM bookings');

// $visitors = $statement->fetchAll(PDO::FETCH_ASSOC);
// print_r($visitors);


// If dates and room are available and if transfer code is valid

function checkAvailability()
{
    //connection to db
    $db = connect('/hotel.db');

    //se if the variables in the form are set
    if (isset($_POST['name'], $_POST['transferCode'], $_POST['arrivalDate'], $_POST['departureDate'], $_POST['rooms'])) {
        $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES));
        $transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));
        $arrivalDate = trim(htmlspecialchars($_POST['arrivalDate'], ENT_QUOTES));
        $departureDate = trim(htmlspecialchars($_POST['departureDate'], ENT_QUOTES));
        $rooms = $_POST['rooms'];



        //if transfer code is valid
        if (isValidUuid($transferCode)) {

            //count the total cost of the booking
            $rooms = intval($rooms);
            $totalCost = totalCost($rooms, $arrivalDate, $departureDate);
            //checks if the transfer code is valid
            $isTransferCodeTrue = checkTransferCode($transferCode, $totalCost);


            $isDateAndRoomAva = checkDateAvailability($name, $transferCode, $arrivalDate, $departureDate, $rooms, $totalCost);

            if ($isDateAndRoomAva) {


                // if the the dates are available
                // if (empty($visitors)) {
                if ($isTransferCodeTrue) {


                    // $isQueryTrue = insertIntoDb($name, $transferCode, $arrivalDate, $departureDate, $rooms, $totalCost);
                    // // if query returns true then insert into db
                    // if ($isQueryTrue)


                    getBookingConf($name, $arrivalDate, $departureDate, $totalCost);
                }
                echo "thank you for your booking";
            } else {
                echo "hej sorry bad code";
            }
        } else {
            echo "sorry the date is not available";
        }
    } else {
        echo "invalid transfer code";
    }
}