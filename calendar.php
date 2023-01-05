<?php

declare(strict_types=1);

require(__DIR__ . '/vendor/autoload.php');
//require(__DIR__ . '/hotelFunctions.php');





use benhall14\phpCalendar\Calendar as Calendar;

$calendar1 = new Calendar;
$calendar2 = new Calendar;
$calendar3 = new Calendar;

$roomCalendar = [
    ["room" => 1, "calendar" => $calendar1],
    ["room" => 2, "calendar" => $calendar2],
    ["room" => 3, "calendar" => $calendar3]

];
foreach ($roomCalendar as $key => $calendar) {

    $calendar = $calendar['calendar'];
    $calendar->useMondayStartingDate();
    // $calendar->stylesheet();
}

function bookedDays(array $roomCalendar)
{

    $database = connect('/hotel.db');

    $statement = $database->query('SELECT bookings.arrival_date, bookings.departure_date, bookings.room_id, rooms.room, rooms.cost FROM bookings INNER JOIN rooms ON rooms.id=bookings.room_id');

    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($reservations)) {
        $mask = true;
    }
    foreach ($roomCalendar as $calendar) {

        foreach ($reservations as $event) {
            if ($event['room_id'] === $calendar['room']) {
                $calendar['calendar']->addEvent($event['arrival_date'], $event['departure_date'], false,  $mask, $event['cost']);
            }
        }
    }
}

bookedDays($roomCalendar);