<?php
session_start();

// Redirect to registration if the user is not logged in
// if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {
//     header('Location: /registration');
//     exit();
// }


// $current_date = date('Y-m-d'); // Get the current date

$config = require("config.php");
$db = new Database($config["database"]);

$user_id = $_SESSION['user']['id'];
// Retrieve user data from the database
$user = $db->query("SELECT * FROM user_data WHERE id = :id", [':id' => $user_id])->findOrFail();

// Get All the recipe notes of the current user to show on the saved page
// Database
$recipe_notes = $db->query("SELECT * FROM recipe_notes WHERE user_id = :user_id", [':user_id' => $user_id])->get();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Check JSON decoding
    if (json_last_error() !== JSON_ERROR_NONE) {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['message' => 'Invalid JSON']);
        exit();
    }

    if ($user['is_paid']) {
        // Save recipe logic
        $db->query("INSERT INTO recipe_notes (recipe_name, recipe_description, recipe_steps, user_id) VALUES (:recipe_name, :recipe_description, :recipe_steps, :user_id)", [
            ':recipe_name' => $data['recipe_name'],
            ':recipe_description' => $data['recipe_description'],
            ':recipe_steps' => $data['recipe_steps'],
            ':user_id' => $user_id
        ]);

        header('Content-Type: application/json');
        echo json_encode(['saved_recipe_note' => $data, 'message' => 'Recipe note saved successfully.']);
        exit();
    } else {
        header('Content-Type: application/json', true, 403);
        echo json_encode(['message' => 'You have exceeded the limit for saving recipes.']);
        exit();
    }
}


require "views/saved.view.php";