<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';

$db = connect('/hotel.db');

$statement = $db->query('SELECT * FROM bookings');

$visitors = $statement->fetchAll(PDO::FETCH_ASSOC);
// print_r($visitors);

if (isset($_POST['name'], $_POST['transferCode'], $_POST['arrivalDate'], $_POST['departureDate'], $_POST['rooms'])) {
    $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES));
    $transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));
    $arrivalDate = trim(htmlspecialchars($_POST['arrivalDate'], ENT_QUOTES));
    $departureDate = trim(htmlspecialchars($_POST['departureDate'], ENT_QUOTES));
    $rooms = trim(htmlspecialchars($_POST['rooms'], ENT_QUOTES));

    // If dates abd room are available and if transfer code is valid

    $query = 'INSERT INTO bookings (name, transfer_code, arrival_date, departure_date, room_id) VALUES (:name, :transfer_code, :arrival_date, :departure_date, :room_id)';

    $statement = $db->prepare($query);

    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':transfer_code', $transferCode, PDO::PARAM_STR);
    $statement->bindParam(':arrival_date', $arrivalDate, PDO::PARAM_STR);
    $statement->bindParam(':departure_date', $departureDate, PDO::PARAM_STR);
    $statement->bindParam(':room_id', $rooms, PDO::PARAM_STR);

    $statement->execute();
}