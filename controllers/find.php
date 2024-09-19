<?php
session_start();

$current_date = date('Y-m-d'); // Get the current date
$limit = 5; // Free user limit

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Find Recipes";

// If user is not register/login the redirect to registration page
if ($_SESSION['loggedIn'] == false || !isset($_SESSION['loggedIn'])) {
    header('Location: /registration');
    exit(); // Stop the script
} else {
    $user_id = $_SESSION['user']['id'];   // Access user data from the session
    // Define limits for free and paid users
    // $limit = $user['is_paid'] ? 50 : 5;
    
    // Retrieve the user data from the database of the logged-in user
    $user = $db->query("SELECT * FROM user_data WHERE id = :id", [
        ':id' => $user_id
    ])->findOrFail();

    
    // Reset search count if it's a new day (free user)
    if ($current_date !== $user['last_search_date']) {
        // Reset search count and update last search date
        $db->query('UPDATE user_data SET no_of_searches = :no_of_searches, last_search_date = :date WHERE id = :id', [
            ':no_of_searches' => 0,
            ':date' => $current_date,
            ':id' => $user_id
        ]);
        $user['no_of_searches'] = 0; // Reset the search count in the user array
    }
    
    // Check if user has exceeded search limit
    if ($user['no_of_searches'] >= $limit) {
        echo json_encode(['limitExceed' => true, 'message' => 'You have reached your daily search limit.']);
        // * In future I will redirect to the payment page
        exit();
    } 
    // Track the user's search and saved how many searches he/she made
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user['no_of_searches'] = $user['no_of_searches'] + 1;
            $_SESSION['searches'] = $user['no_of_searches']; // Save the search count in the session
            //dd($_SESSION['searches']);
            
            // Query to save search count in the database of the logged-in user
            $db->query('UPDATE user_data SET no_of_searches = :searches WHERE id = :id', [
                ':searches' => $user['no_of_searches'],
                ':id' => $user_id
            ]);

            echo json_encode(['limitExceed' => false, 'searchCount' => $user['no_of_searches']]);
            exit();
        }
}

require "views/find.view.php";