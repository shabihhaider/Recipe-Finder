<?php
session_start();

if ($_SESSION['loggedIn'] || $_SESSION['user']) {

    $user = $_SESSION['user']; // Get user details

    // Extract data all the data (recipes of user that he create) [recipe notes]


} else {
    $error['userNotLogIn'] = "You are not logIn.";
}

require "views/recipe-create.view.php";