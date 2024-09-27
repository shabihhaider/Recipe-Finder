<?php
session_start();

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Saved Recipes";

// Access user data from the session
// If user is exist and loggedIn (both cases are same either you can user $_SESSION['user'] or $_SESSION['loggedIn'] == true)
if(isset($_SESSION['user']) && $_SESSION['loggedIn'] == true) {
    $user = $_SESSION['user'];

    // Retrieve the saved recipes from the database of the logged-in user
    $recipes = $db->query("SELECT * FROM saved_recipes WHERE user_id = :user_id", [
        ':user_id' => $user['id']
    ])->get();
    // echo "The logged-in user is: " . $user['id'];

} else {
    $error['noUser'] = "No user. No Data. Please LogIn to create and saved Recipes.";
}

require "views/saved.view.php";