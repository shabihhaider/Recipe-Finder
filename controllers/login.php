<?php

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "LogIn";

// Retrieve the data from the form and check with tha data that is stored in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $success = false;
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // since email is unique, we get the user with the email and check if the password is correct of that user
    $user = $db->query("SELECT * FROM user_data WHERE email = :email", [
        ':email' => $_POST['email']
        ])->find();
        
        //dd(password_verify($password, $user['passw']));
        // Check if the user exists before verifying the password
        // Convert the hashed password to plain text
        if ($user && password_verify($password, $user['passw'])) {
            $success = true;
            
            // Start Session
            session_start(); // Start the session means that the session is started and the data is stored in the server and we can access it from any page just by writing session_start() at the top of that page where we want to access the data
            
            // Store user data in the session
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user; // Session is a global variable that is used to store the data of the user in the server
            
            // Redirect to the home page
            header("Location: /");
            exit(); // Ensure script stops executing after redirect
        } else {
            $errors['email_password'] = "Check your Email or Password";
            $errors['exist'] = "User doesn't exist";
    }
}

require "views/login.view.php";