<?php

declare(strict_types=1);
require(__DIR__ . '/vendor/autoload.php');



use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

use benhall14\phpCalendar\Calendar as Calendar;

$calendar->stylesheet();

//a function that checks the transfer code

function checkTransferCode(string $transferCode, int $totalCost)
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

        return  false;
    } else {
        return true;
    }
}

// a function that calculates the total cost of the booking
function totalCost(int $room_id, string $arrivalDate, string $departureDate)
{
    $db = connect('/hotel.db');
    $stmt = $db->prepare('SELECT cost FROM rooms WHERE id = :room_id');
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
    $stmt->execute();

    $cost = $stmt->fetch(PDO::FETCH_ASSOC);
    $cost = $cost['cost'];

    //counts the total cost of the booking
    $totalCost = (((strtotime($departureDate) - strtotime($arrivalDate)) / 86400) * $cost);
    return $totalCost;
}

function checkDateAvailability(string $arrivalDate, string $departureDate, int $room_id)
{
    //get data from db
    $db = connect('/hotel.db');

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
}

function insertIntoDb(string $name, string $transferCode, string $arrivalDate, string $departureDate, int $room_id, int $totalCost)
{
    $db = connect('/hotel.db');
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


function getBookingConf(string $name, string $arrivalDate, string $departureDate, int $totalCost)
{
    $receipt = [
        'island' => "Tech Island",
        'hotel' => "Silicon-Vali",
        'name' => $name,
        'arrival_date' => $arrivalDate,
        'departure_date' => $departureDate,
        'total_cost' => $totalCost,
        'stars' => "1"

    ];
    // echo "Thank You for your reservation at our " . $receipt['stars'] . "-Star " . $receipt['hotel'] . ", $name!" . "<br>" . "Your arrival date is " . "$arrivalDate " . "<br>" . "and your departure date is " . "$departureDate." . "<br>" . "The total fee for your stay is " . $receipt['total_cost'] . "." . "<br>" . "We are looking forward seeing You!";


    $getData = file_get_contents(__DIR__ . '/receipts/receipt.json');
    $tempArray = json_decode($getData, true);
    array_push($tempArray, $receipt);
    $json = json_encode($tempArray);
    file_put_contents(__DIR__ . '/receipts/receipt.json', $json);

    print_r(end($tempArray));
}
function bookedDays()
{


    if (isset($_POST['arrivalDate'], $_POST['departureDate'], $_POST['rooms'])) {

        $arrivalDate = trim(htmlspecialchars($_POST['arrivalDate'], ENT_QUOTES));
        $departureDate = trim(htmlspecialchars($_POST['departureDate'], ENT_QUOTES));
        $rooms = $_POST['rooms'];
        $rooms = intval($rooms);

        checkDateAvailability($arrivalDate, $departureDate, $rooms);


        $events[] = array(
            'start' => $arrivalDate,
            'end' => $departureDate,
            'summary' => 'Booked',
            'mask' => true
        );

        $calendar = new Calendar;
        $calendar->useMondayStartingDate();
        $calendar->addEvents($events)->display(date('Y-m-d'));
    }
}