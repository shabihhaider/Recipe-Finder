<?php
session_start();

require "Validator.php";

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Create a Recipe";

if(isset($_SESSION['user'])) {
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $errors = [];
        $success = false;

        // Check Recipe name if it is not null
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
    
} else {
    // If there is no user then user cannot create or post a recipe
    $errors['create'] = "You cannot create a Recipe because you are not loggedIn.";
    header("Location: /login");
    exit(); // Ensure script stops executing after redirect
}


require "views/recipe-create.view.php";