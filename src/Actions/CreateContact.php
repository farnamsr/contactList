<?php

header('Content-Type: application/json');
use Illuminate\Database\Capsule\Manager as DB;


$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$phone = $_POST['phoneNumber'];



$contact = DB::table('contacts')->insert([
    'fullname' => $fullname,
    'email' => $email,
    'username' => $username,
    'phone_number' => $phone,
]);



echo json_encode([
    "contact" => $contact
]);
