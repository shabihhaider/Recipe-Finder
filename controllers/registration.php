<?php

require "Validator.php";

$config = require("config.php");

$db = new Database($config["database"]);

$heading = "Registration Form";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $success = false;
    $exist = false;

    // Check if user is already registered (in our database)
        $user = $db->query("SELECT * FROM user_data WHERE email = :email", [
            ':email' => $_POST['email']
            ])->find();

    if($user) {
        $exist = true;
        $errors['exist'] = "This email is already exists. Please Login!";
    } else {
            // If there are no errors (New user), then save the user
            $db->query("INSERT INTO user_data (username, email, passw) VALUES (:firstname, :email, :passw)", [
                ':firstname' => $_POST['firstname'],
                ':email' => $_POST['email'],
                ':passw' => password_hash($_POST['password'], PASSWORD_DEFAULT) // Hash the password means to encrypt the password and then store it in the database
            ]);
            
            // Successfully! Saved data in Database
            $success = true;
            
            // Redirect to login
            header("Location: /login");
            exit(); // Ensure script stops executing after redirect
    }
}   
require "views/registration.view.php";