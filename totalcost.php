<?php

declare(strict_types=1);


function totalCost(int $room_id, string $arrivalDate, string $departureDate)
{
    $db = connect('/hotel.db');
    $stmt = $db->prepare('SELECT cost FROM rooms WHERE id = :room_id');
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
    $stmt->execute();

    $cost = $stmt->fetch(PDO::FETCH_ASSOC);
    $cost = $cost["cost"];
    // print_r($cost);


    //counts the total cost of the booking
    $totalCost = (((strtotime($departureDate) - strtotime($arrivalDate)) / 86400) * $cost);
    return $totalCost;
}