<?php
session_start();

// Access user data from the session
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // echo "The logged-in user is: " . $user['id'];
} else {
    echo "No user data found in the session.";
}

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Saved Recipes";

// Retrieve the saved recipes from the database of the logged-in user
$recipes = $db->query("SELECT * FROM saved_recipes WHERE user_id = :user_id", [
    ':user_id' => $user['id']
])->get();

require "views/saved.view.php";