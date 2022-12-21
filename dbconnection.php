<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';


// $statement = $db->query('SELECT * FROM bookings');

// $visitors = $statement->fetchAll(PDO::FETCH_ASSOC);
// print_r($visitors);


// $inputArrival = $arrivalDate;
// $inputDeparture = $departureDate;
// $inputRoom = $rooms;
// If dates and room are available and if transfer code is valid

function checkAvailability()
{

    $db = connect('/hotel.db');

    if (isset($_POST['name'], $_POST['transferCode'], $_POST['arrivalDate'], $_POST['departureDate'], $_POST['rooms'])) {
        $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES));
        $transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));
        $arrivalDate = trim(htmlspecialchars($_POST['arrivalDate'], ENT_QUOTES));
        $departureDate = trim(htmlspecialchars($_POST['departureDate'], ENT_QUOTES));
        $rooms = $_POST['rooms'];

        //get data from db
        $statement = $db->query('SELECT * FROM bookings
        WHERE
        room_id = :room_id
        AND
        (arrival_date <= :arrival_date
        or arrival_date < :departure_date)
        AND
        (departure_date > :arrival_date or
        departure_date > :departure_date)');

        $statement->bindParam(':arrival_date', $arrivalDate, PDO::PARAM_STR);
        $statement->bindParam(':departure_date', $departureDate, PDO::PARAM_STR);
        $statement->bindParam(':room_id', $rooms, PDO::PARAM_INT);

        $statement->execute();

        $visitors = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (empty($visitors)) {
            $query = 'INSERT INTO bookings (name, transfer_code, arrival_date, departure_date, room_id) VALUES (:name, :transfer_code, :arrival_date, :departure_date, :room_id)';

            $statement = $db->prepare($query);

            $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->bindParam(':transfer_code',  $transferCode, PDO::PARAM_STR);
            $statement->bindParam(':arrival_date',  $arrivalDate, PDO::PARAM_STR);
            $statement->bindParam(':departure_date',  $departureDate, PDO::PARAM_STR);
            $statement->bindParam(':room_id',  $rooms, PDO::PARAM_INT);

            $statement->execute();
        } elseif (!empty($visitors)) {
            echo "sorry the date is not available";
        }
    }
};
checkAvailability();