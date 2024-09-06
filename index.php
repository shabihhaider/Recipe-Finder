<?php

require "functions.php";

//require "router.php";

require "Database.php";

$config = require("config.php");

$db = new Database($config["database"]);

$id = $_GET['id']; // $_GET is a superglobal array that contains all the URL parameters (query string e.g. ?name=John&age=30)

$query = "SELECT * FROM user_data WHERE id = :id"; // Never ever inline query

$posts = $db->query($query, [':id' => $id])->fetch();

dd($posts);