<?php

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Create a Recipe";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db->query("INSERT INTO saved_recipes (recipe_name, user_id) VALUES (:recipe_name, :user_id)", [
        ':recipe_name' => $_POST['recipe'],
        ':user_id' => 1
    ]);
}

require "views/recipe-create.view.php";