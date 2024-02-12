<?php


use Illuminate\Database\Capsule\Manager as DB;

require_once realpath("vendor/autoload.php");
require_once realpath("src/Core/Router.php");



//--- Initializing Database Connection
$db = new DB;
$db->addConnection(require_once "src/Config/database.php");
$db->setAsGlobal();
$db->bootEloquent();



//--- Defining Routes
Router::get("/", "src/Actions/Home.php");
Router::post("/contacts", "src/Actions/GetContacts.php");
Router::post("/contact", "src/Actions/CreateContact.php");
Router::dispatch();







