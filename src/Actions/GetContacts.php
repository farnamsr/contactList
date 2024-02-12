<?php

header('Content-Type: application/json');
use Illuminate\Database\Capsule\Manager as DB;

$contacts = [];
$keyword = $_POST['keyword'];

if(isset($keyword)) {
    $contacts = DB::table("contacts")->where(function ($query) use ($keyword) {
        $query->where('fullname', 'LIKE', "%$keyword%")
              ->orWhere('username', 'LIKE', "%$keyword%")
              ->orWhere('phone_number', 'LIKE', "%$keyword%")
              ->orWhere('email', 'LIKE', "%$keyword%");
    })->get();
}
else{
    $contacts = DB::table('contacts')->get();
}



echo json_encode([
    "contacts" => $contacts
]);
