<?php

require "functions.php";

//require "router.php";

require "Database.php";

$db = new Database();

$posts = $db->query("SELECT * FROM user_data")->fetchAll(PDO::FETCH_ASSOC);

dd($posts);