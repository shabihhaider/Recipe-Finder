<?php


$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Saved Recipes";

$recipes = $db->query("SELECT * FROM saved_recipes WHERE user_id = 1")->fetchAll();

require "views/saved.view.php";