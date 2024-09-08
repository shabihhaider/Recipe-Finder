<?php
session_start();

// Access user data from the session
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // echo "The logged-in user is: " . $user['id'];
} else {
    echo "No user data found in the session.";
}

require "Validator.php";

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Create a Recipe";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $success = false;

    if(! Validator::string($_POST['recipe'], 1, 100)) {
        $errors['recipe'] = "Recipe name is required min 1 and max 100 characters";
    }

    // If there are no errors, then save the recipe
    if(empty($errors)) {
        $db->query("INSERT INTO saved_recipes (recipe_name, user_id) VALUES (:recipe_name, :user_id)", [
            ':recipe_name' => $_POST['recipe'],
            ':user_id' => $_SESSION['user']['id']
        ]);
        $success = true;
    }
    
}

require "views/recipe-create.view.php";