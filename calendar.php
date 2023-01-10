<?php

declare(strict_types=1);

require(__DIR__ . '/vendor/autoload.php');


use benhall14\phpCalendar\Calendar as Calendar;

//different calendars for each room
$calendar1 = new Calendar;
$calendar2 = new Calendar;
$calendar3 = new Calendar;

//array with calendar and room type
$roomCalendar = [
    ["room" => 1, "calendar" => $calendar1],
    ["room" => 2, "calendar" => $calendar2],
    ["room" => 3, "calendar" => $calendar3]

];

//foreach to match calendar and room
foreach ($roomCalendar as $key => $calendar) {

    $calendar = $calendar['calendar'];
    $calendar->useMondayStartingDate();
}

// function that add booked days to the calendar
function bookedDays(array $roomCalendar)
{
    //db connection
    $database = connect('/hotel.db');

    //sql query
    $statement = $database->query('SELECT bookings.arrival_date, bookings.departure_date, bookings.room_id, rooms.room FROM bookings INNER JOIN rooms ON rooms.id=bookings.room_id');

    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($reservations)) {
        $mask = true;
    }
    //foreach that loops booked days and adds them to the calendar
    foreach ($roomCalendar as $calendar) {

        foreach ($reservations as $event) {
            if ($event['room_id'] === $calendar['room']) {
                $calendar['calendar']->addEvent($event['arrival_date'], $event['departure_date'], "",  $mask, "");
            }
        }
    }
}

bookedDays($roomCalendar);