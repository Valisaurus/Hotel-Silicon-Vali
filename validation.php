<?php

declare(strict_types=1);

require(__DIR__ . '/hotelFunctions.php');
require(__DIR__ . '/functions.php');



// function that checks if form variables are set and calls on other

function validationForm()
{

    //checks if the variables in the form are set
    if (isset($_POST['name'], $_POST['transferCode'], $_POST['arrivalDate'], $_POST['departureDate'], $_POST['rooms'])) {

        $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES));
        $transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));
        $arrivalDate = trim(htmlspecialchars($_POST['arrivalDate'], ENT_QUOTES));
        $departureDate = trim(htmlspecialchars($_POST['departureDate'], ENT_QUOTES));
        $rooms = $_POST['rooms'];

        //makes $rooms into an int
        $rooms = intval($rooms);

        // calls on function that checks if dates are available
        if (checkDateAvailability($arrivalDate, $departureDate, $rooms)) {

            if (empty($name)) {
                echo "please enter your name";
                return false;
            }
            //calls on function that checks if uuid is valid
            if (isValidUuid($transferCode)) {

                //calls on function that counts the total cost of the booking
                $totalCost = totalCost($rooms, $arrivalDate, $departureDate);

                //calls on function that checks if the transfer code and deposit are valid
                $isTransferCodeTrue = checkTransferCode($transferCode, $totalCost);
                $isDepositTrue = deposit($transferCode);

                if ($isTransferCodeTrue && $isDepositTrue) {

                    // function that inserts data into db is called if all above functions are valid
                    insertIntoDb($name, $transferCode, $arrivalDate, $departureDate, $rooms, $totalCost);

                    getBookingConf($name, $arrivalDate, $departureDate, $totalCost);
                } else {
                    echo "Sorry the transfer code could not be found or already used or not enough money! Please try another transfer code!";
                }
            } else {
                echo "Sorry invalid format on transfer code!";
            }
        } else {
            echo "Sorry the dates are not available!";
        }
    }
}