<?php


$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Saved Recipes";
$currentUserId = 1;

$recipe = $db->query("SELECT * FROM saved_recipes WHERE id = :id", [
    ':id' => $_GET['id']
])->findOrFail();

// If the user is not the current user, then abort
authorize($recipe['user_id'] === $currentUserId);

require "views/recipe.view.php";