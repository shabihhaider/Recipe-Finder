<?php


$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Saved Recipes";

$recipe = $db->query("SELECT * FROM saved_recipes WHERE id = :id", [':id' => $_GET['id']])->fetch();

require "views/recipe.view.php";