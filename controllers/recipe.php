<?php
session_start();
$currentUserId = $_SESSION['user']['id'];   // Access user data from the session

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Saved Recipes";

// Retrieve the saved recipes from the database of the logged-in user
$recipe = $db->query("SELECT * FROM saved_recipes WHERE id = :id", [
    ':id' => $_GET['id']
])->findOrFail();

// If the user is not the current user, then abort
authorize($recipe['user_id'] === $currentUserId);

require "views/recipe.view.php";