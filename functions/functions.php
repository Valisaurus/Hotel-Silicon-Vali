<?php

declare(strict_types=1);
require(__DIR__ . '/../vendor/autoload.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


//function that checks the transfer code and total cost

function checkTransferCode(string $transferCode, int $totalCost): bool
{
    $client = new Client();
    $response = $client->request(
        'POST',
        'https://www.yrgopelago.se/centralbank/transferCode',
        [
            'form_params' => [
                'transferCode' => $transferCode,
                'totalcost' => $totalCost
            ]
        ]
    );

    if ($response->hasHeader('Content-Length')) {
        $transfer_code = json_decode($response->getBody()->getContents());
    }
    if (isset($transfer_code->error)) {

        return false;
    } else {
        return true;
    }
}


//  function that makes a deposit
function deposit(string $transferCode): bool
{
    $client = new Client();
    $response = $client->request(
        'POST',
        'https://www.yrgopelago.se/centralbank/deposit',
        [
            'form_params' => [
                'user' => "vali",
                'transferCode' => $transferCode

            ]
        ]
    );

    if ($response->hasHeader('Content-Length')) {
        $transfer_code = json_decode($response->getBody()->getContents());
    }
    if (isset($transfer_code->message)) {

        return  true;
    } else {
        return false;
    }
}


// function that calculates the total cost of the booking
function totalCost(int $room_id, string $arrivalDate, string $departureDate): int|bool
{
    //db connection
    $db = connect('hotel.db');

    //sql query
    $stmt = $db->prepare('SELECT cost FROM rooms WHERE id = :room_id');
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
    $stmt->execute();

    $cost = $stmt->fetch(PDO::FETCH_ASSOC);
    $cost = $cost['cost'];

    //counts the total cost of the booking
    $totalCost = (((strtotime($departureDate) - strtotime($arrivalDate)) / 86400) * $cost);
    return $totalCost;
}

//function that checks if chosen dates are available
function checkDateAvailability(string $arrivalDate, string $departureDate, int $room_id): bool
{
    //db connection
    $db = connect('hotel.db');

    //sql query
    $statement = $db->prepare('SELECT * FROM bookings
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
    $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);

    $statement->execute();

    $visitors = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (empty($visitors) && $departureDate > $arrivalDate) {
        return true;
    }
    return false;
}


function prices()
{
    //db connection
    $database = connect('hotel.db');

    //sql query
    $statement = $database->query('SELECT cost FROM rooms');

    $statement->execute();
    $prices = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $prices;
}




//function that inserts data from form to db
function insertIntoDb(string $name, string $transferCode, string $arrivalDate, string $departureDate, int $room_id, int $totalCost): void
{
    //db connection
    $db = connect('hotel.db');

    //sql query
    $query = "INSERT INTO bookings (name, transfer_code, arrival_date, departure_date, room_id, total_cost) VALUES (:name, :transfer_code, :arrival_date, :departure_date, :room_id, :total_cost)";

    $statement = $db->prepare($query);

    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':transfer_code',  $transferCode, PDO::PARAM_STR);
    $statement->bindParam(':arrival_date',  $arrivalDate, PDO::PARAM_STR);
    $statement->bindParam(':departure_date',  $departureDate, PDO::PARAM_STR);
    $statement->bindParam(':room_id',  $room_id, PDO::PARAM_INT);
    $statement->bindParam(':total_cost', $totalCost, PDO::PARAM_INT);

    $statement->execute();
}




//function that gives a receipt when booked
function getBookingConf(string $name, string $arrivalDate, string $departureDate, int $totalCost): void
{
    $receipt = [
        'island' => "Tech Island",
        'hotel' => "Silicon-Vali",
        'name' => $name,
        'arrival_date' => $arrivalDate,
        'departure_date' => $departureDate,
        'total_cost' => $totalCost,
        'stars' => "1",
        'features' => [],
        'addtional_info' => "Thank you for booking Hotel-Silicon-Vali, Hope you have a nice stay."

    ];


    $getData = file_get_contents(__DIR__ . '/../receipts/receipt.json');
    $tempArray = json_decode($getData, true);
    array_push($tempArray, $receipt);
    $json = json_encode($tempArray);
    file_put_contents(__DIR__ . '/../receipts/receipt.json', $json);

    echo "Thank you for your booking" . " " . $name . "." . " " . "Here is your receipt <br>";
    echo json_encode(end($tempArray));
}