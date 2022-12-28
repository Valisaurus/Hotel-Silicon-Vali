<?php

declare(strict_types=1);
require(__DIR__ . '/vendor/autoload.php');



use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


$client = new Client();

$response = $client->request(
    'POST',
    'https://www.yrgopelago.se/centralbank/transferCode',
    [
        'form_params' => [
            'transferCode' => '324ddb65-2c8e-9699-873aea73977e',
            'totalcost' => 10
        ]
    ]
);

if ($response->hasHeader('Content-Length')) {
    $transfer_code = json_decode($response->getBody()->getContents());
}


// if ($response->hasHeader('Content-Length')) {
//     $transfer_code = json_decode($response->getBody()->getContents());
//     echo "<pre>";
//     var_dump($transfer_code);

//     if (isset($transfer_code->transferCode)) {
//         echo "valid code";
//     } elseif ($transfer_code->error = "invalid guid") {
//         // echo "invalid code";
//     }
//      elseif ($transfer_code->error = "Not a valid GUID") {
//         // echo "not enough money";
//     }
//     var_dump($transfer_code->error);
// }





//isValidUuid('transferCode');


  // } elseif($tansfer_code->transferCode){
        // echo "valid code";
    // }

// if ($response->hasHeader('Content-Length')) {
//     $transfer_code = json_decode($response->getBody()->getContents());
//     echo "<pre>";
//     var_dump($transfer_code);
//     echo "<pre>";
// }

// declare(strict_types=1);
// require __DIR__ . '/vendor/autoload.php';



// use GuzzleHttp\Client;
// use GuzzleHttp\Exception\ClientException;



// $client = new Client();

// try {
//     $response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/transferCode', [
//         'form_params' => [
//             'transferCode' => 'a37f8f0f-0be4-47fc-a162-b2249f805af5',
//             'totalCost' => '10'

//         ]
//     ]);
// } catch (ClientException $e) {
//     echo $e->getMessage();
// }

// $body = $response->getBody();

// echo $body;

//var_dump($response->getBody()->getContents());


// $client = new Client([
//     'base_uri' => 'https://www.yrgopelago.se/centralbank/transferCode'
// ]);

// $response = $client->request(
//     'POST',
//     'https://www.yrgopelago.se/centralbank/transferCode',
//     [
//         'form_params' => [
//             'transferCode' => 'ab14cbb2-f550-46e6-97c2-bb7f0126733e'
//         ]
//     ]
// );

// if ($response->hasHeader('Content-Length')) {
//     $transfer_code = json_decode($response->getBody()->getContents());
//     var_dump($transfer_code);
// }



// try {
//     $response = $client->get('https://www.yrgopelago.se/centralbank/transferCode');
// } catch (ClientException $e) {
//     echo $e->getMessage();
// }

// if ($response->getBody()) {
//     $accountInfo = json_decode($response->getBody()->getContents());
// }





// echo "<pre>";
// var_dump($transfer_code);
// echo "<pre>";