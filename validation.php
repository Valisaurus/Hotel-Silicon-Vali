<?php

declare(strict_types=1);

require(__DIR__ . '/hotelFunctions.php');
require(__DIR__ . '/functions.php');



// If dates and room are available and if transfer code is valid

function validationForm()
{

    //se if the variables in the form are set
    if (isset($_POST['name'], $_POST['transferCode'], $_POST['arrivalDate'], $_POST['departureDate'], $_POST['rooms'])) {

        $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES));
        $transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));
        $arrivalDate = trim(htmlspecialchars($_POST['arrivalDate'], ENT_QUOTES));
        $departureDate = trim(htmlspecialchars($_POST['departureDate'], ENT_QUOTES));
        $rooms = $_POST['rooms'];

        //makes $rooms into an int
        $rooms = intval($rooms);

        if (checkDateAvailability($arrivalDate, $departureDate, $rooms)) {

            if (empty($name)) {
                echo "please enter your name";
                return false;
            }
            //if transfer code is valid
            if (isValidUuid($transferCode)) {

                //count the total cost of the booking
                $totalCost = totalCost($rooms, $arrivalDate, $departureDate);

                //checks if the transfer code is valid
                $isTransferCodeTrue = checkTransferCode($transferCode, $totalCost);

                if ($isTransferCodeTrue) {

                    insertIntoDb($name, $transferCode, $arrivalDate, $departureDate, $rooms, $totalCost);

                    getBookingConf($name, $arrivalDate, $departureDate, $totalCost);
                } else {
                    echo "Sorry not enough money";
                }
            } else {
                echo "sorry invalid transfer code";
            }
        } else {
            echo "sorry the date is not available";
        }
    }
}