<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$curl = curl_init();

if(isset($_GET['postcode'])) {
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://epc.opendatacommunities.org/api/v1/domestic/search?postcode='.$_GET['postcode'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Authorization: Basic'
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    $rows = json_decode($response)->rows;
    // $addressesArray = array_column($rows, 'address');
    // $addressesQueryString = implode(', ', $addressesArray);
    
    echo json_encode($rows);
} else if(isset($_GET['address'])) {
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://epc.opendatacommunities.org/api/v1/domestic/search?address='.urlencode($_GET['address']),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Authorization: Basic ZGFtaWVuQHJlZHJhYmJpdGRpZ2l0YWwuY29tOmQ1YjhjNDZlZmI5OWI4ZTFjODY3YWY3OWIyYmM1MmEzMWQ2OGRiNTI='
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    // $rows = json_decode($response)->rows;
    // $addressesArray = array_column($rows, 'address');
    // $addressesQueryString = implode(', ', $addressesArray);
    
    echo $response;
} else if(isset($_GET['lmk-key'])) {
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://epc.opendatacommunities.org/api/v1/domestic/certificate/'.urlencode($_GET['lmk-key']),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'Accept: application/json',
      'Authorization: Basic ZGFtaWVuQHJlZHJhYmJpdGRpZ2l0YWwuY29tOmQ1YjhjNDZlZmI5OWI4ZTFjODY3YWY3OWIyYmM1MmEzMWQ2OGRiNTI='
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  echo $response;

} else if(isset($_GET['create-contact'])) {
//   var_dump('post', $_POST);
  $data = file_get_contents("php://input");
  $jsonData = json_decode($data);
  // var_dump('post', $jsonData);

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.gohighlevel.com/v1/contacts/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJsb2NhdGlvbl9pZCI6IkJQUHRzU1BaV0pERlV6YjlONkRZIiwiY29tcGFueV9pZCI6IjFudWNHSXk3SndzSkRjaG1oeTJTIiwidmVyc2lvbiI6MSwiaWF0IjoxNjk5NjEwNDc4NjA1LCJzdWIiOiJ1c2VyX2lkIn0.qHkAIhgI0eel8w9CpnVn3WnQwIISuYoe8vOgkUKdc54'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  echo $response;
}
