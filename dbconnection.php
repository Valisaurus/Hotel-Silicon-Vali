<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';
require __DIR__ . '/apiconnection.php';



// $statement = $db->query('SELECT * FROM bookings');

// $visitors = $statement->fetchAll(PDO::FETCH_ASSOC);
// print_r($visitors);


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
        $statement->bindParam(':room_id', $rooms, PDO::PARAM_INT);


        $statement->execute();

        $visitors = $statement->fetchAll(PDO::FETCH_ASSOC);




        //if transfercode is valid
        if (isValidUuid($transferCode)) {

            $stmt = $db->prepare('SELECT cost FROM rooms WHERE id = :room_id');
            $stmt->bindParam(':room_id', $rooms, PDO::PARAM_INT);
            $stmt->execute();

            $cost = $stmt->fetch(PDO::FETCH_ASSOC);
            $cost = $cost["cost"];
            // print_r($cost);



            $totalCost = (((strtotime($departureDate) - strtotime($arrivalDate)) / 86400) * $cost);





            if (empty($visitors)) {
                $query = "INSERT INTO bookings (name, transfer_code, arrival_date, departure_date, room_id, total_cost) VALUES (:name, :transfer_code, :arrival_date, :departure_date, :room_id, :total_cost)";

                $statement = $db->prepare($query);

                $statement->bindParam(':name', $name, PDO::PARAM_STR);
                $statement->bindParam(':transfer_code',  $transferCode, PDO::PARAM_STR);
                $statement->bindParam(':arrival_date',  $arrivalDate, PDO::PARAM_STR);
                $statement->bindParam(':departure_date',  $departureDate, PDO::PARAM_STR);
                $statement->bindParam(':room_id',  $rooms, PDO::PARAM_INT);
                $statement->bindParam(':total_cost', $totalCost, PDO::PARAM_INT);

                $statement->execute();

                $receipt = [
                    'island' => "Tech Island",
                    'hotel' => "Silicon-Vali",
                    'name' => $name,
                    'arrival_date' => $arrivalDate,
                    'departure_date' => $departureDate,
                    'total_cost' => $totalCost,
                    'stars' => "1"

                ];



                $getData = file_get_contents(__DIR__ . '/receipt.json');
                $tempArray = json_decode($getData, true);
                array_push($tempArray, $receipt);
                // print_r($tempArray);
                $json = json_encode($tempArray);
                file_put_contents(__DIR__ . '/receipt.json', $json);
                // print_r($json);


                // print_r($json);

                // File_put_contents(__DIR__ . '/receipts/' . $name . ".json", $receipt, FILE_APPEND);


                // print_r($totalCost);

                echo "thank you for your booking";
            } else {
                echo "sorry the date is not available";
            }
        } else {
            echo "invalid transfer code";
        }
    }
};