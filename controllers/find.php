<?php
session_start();

$heading = "Find Recipes";

// If user is not register/login the redirect to registration page
if ($_SESSION['loggedIn'] == false) {
    header('Location: /registration');
    exit(); // Stop the script
}
require "views/find.view.php";