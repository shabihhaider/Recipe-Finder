<?php


$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Saved Recipes";
$currentUserId = 1;

$recipe = $db->query("SELECT * FROM saved_recipes WHERE id = :id", [
    ':id' => $_GET['id']
])->fetch();

// If the recipe does not exist
if (! $recipe) {
    abort();
}

// If the user is not the current user
if ($recipe['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

require "views/recipe.view.php";