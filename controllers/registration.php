<?php

require "Validator.php";

$config = require("config.php");

$db = new Database($config["database"]);

$heading = "Registration Form";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $success = false;
    $exist = false;

    // // Check Username if it is not null
    // if (! Validator::string($_POST['firstname'])) {
    //     $errors['firstname'] = "Username is Required";
    // }

    // // Check email
    // if(! Validator::email($_POST['email'])) {
    //     $errors['email'] = "Input a valid email address";
    // }

    // // Check password if it is not null
    // if(! Validator::password($_POST['password'], 8, 30)) {
    //     $errors['password'] = "Password length is at least 8 characters";
    // }

    // // Check repeat-password if it is not equal to password
    // if ($_POST['password'] !== $_POST['repeat-password']) {
    //     $errors['repeat-password'] = "Passwords do not match";
    // }

    // check if there is any user in the database (If database is empty)
    $users = $db->query("SELECT * FROM user_data")->get();
    // If datsbase is not empty 
    if (!empty($users)) {
        
        // Check if user is already registered (in our database)
        $user = $db->query("SELECT * FROM user_data WHERE email = :email", [
            ':email' => $_POST['email']
            ])->findOrFail();
            
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
    } else {
        // If database is empty then save the user
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