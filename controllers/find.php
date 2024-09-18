<?php
session_start();
$user_id = $_SESSION['user']['id'];   // Access user data from the session

// Define limits for free and paid users
// $limit = $user['is_paid'] ? 50 : 5;
$limit = 5; // Free user limit

$config = require("config.php");
$db = new Database($config["database"]);

$heading = "Find Recipes";
$current_date = date('Y-m-d'); // Get the current date



// If user is not register/login the redirect to registration page
if ($_SESSION['loggedIn'] == false) {
    header('Location: /registration');
    exit(); // Stop the script
} else { // else user is loggedIn then see that user has exceeded the search limit or not
    // Retrieve the user data from the database of the logged-in user
    $user = $db->query("SELECT * FROM user_data WHERE id = :id", [
        ':id' => $user_id
    ])->findOrFail();
    
    // Check if user has exceeded search limit
    if ($user['no_of_searches'] >= $limit) {
        echo "You have reached your daily search limit.";
    } else {

        // Check if it's a new day (free user)
        if ($current_date !== $user['last_search_date']) {
            // Reset search count and update last search date
            $db->query('UPDATE user_data SET no_of_searches = 0, last_search_date = :date WHERE id = :id', [
                ':date' => $current_date,
                ':id' => $user_id
            ]);
        }

        // Track the user's search and saved how many searches he/she made
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['searches'] = $_SESSION['searches'] + 1;
            //dd($_SESSION['searches']);
            
            // Query to save search count in the database of the logged-in user
            $db->query('UPDATE user_data SET no_of_searches = :searches WHERE id = :id', [
                ':searches' => $_SESSION['searches'],
                ':id' => $_SESSION['user']['id']
            ]);
        }
    }
}

require "views/find.view.php";