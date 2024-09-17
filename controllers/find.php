<?php
session_start();

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Find Recipes";

// If user is not register/login the redirect to registration page
if ($_SESSION['loggedIn'] == false) {
    header('Location: /registration');
    exit(); // Stop the script
}

// Track the user's search and saved how many searches he/she made
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['searches'] = $_SESSION['searches'] + 1;
    //dd($_SESSION['searches']);
    
    // Query to save search count in the database of the logged-in user
    $db->query('UPDATE user_data SET no_of_searches = :searches WHERE id = :id', [
        ':searches' => $_SESSION['searches'],
        ':id' => $_SESSION['user']['id']
    ]);
}


require "views/find.view.php";