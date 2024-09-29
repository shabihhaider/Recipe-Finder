<?php

session_start();

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Your Favourite Recipes";
$savedRecipes = [];

if(isset($_SESSION['user']) && $_SESSION['loggedIn'] == true) {
    $user = $_SESSION['user'];
    $user_id = $user['id'];

    $savedRecipes = $db->query("SELECT * FROM saved_recipes WHERE user_id = :user_id", [
        ':user_id' => $user_id
    ])->get(); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        //file_put_contents('php://stderr', print_r($json, true)); // Log raw input to error log

        $data = json_decode($json, true);

        // if (json_last_error() !== JSON_ERROR_NONE) {
        //     echo 'JSON Error: ' . json_last_error_msg();
        //     exit;
        // }

        if (isset($data['recipeID']) && $user_id) {
            $recipeId = $data['recipeID'];
            $recipeTitle= $data['recipeTitle'];
            $recipeImage = $data['recipeImage'];

            // Check if the recipe is already saved
            $result = $db->query("SELECT * FROM saved_recipes WHERE user_id = :user_id AND recipe_id = :recipe_id", [
                ':user_id' => $user_id,
                ':recipe_id' => $recipeId
            ])->get();

            if (empty($result)) {
                $db->query("INSERT INTO saved_recipes (user_id, recipe_id, recipe_title, recipe_image) VALUES (:user_id, :recipe_id, :recipe_title, :recipe_image)", [
                    ':user_id' => $user_id,
                    ':recipe_id' => $recipeId,
                    ':recipe_title' => $recipeTitle,
                    ':recipe_image' => $recipeImage
                ]);
        }
        // Respond with saved successfully
        header('Content-Type: application/json');
            echo json_encode([
                'saved' => true,
                'message' => 'Recipe saved successfully',
                'savedData' => $data
            ]);
            exit;
        }
    }
}

require "views/favourites.view.php";