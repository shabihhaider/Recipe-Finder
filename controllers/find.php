<?php
session_start();

// Redirect to registration if the user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {
    header('Location: /registration');
    exit();
}

$current_date = date('Y-m-d'); // Get the current date
$limitExceed = 0;

// Database
$config = require("config.php");
$db = new Database($config["database"]);

$user_id = $_SESSION['user']['id'];
// Retrieve user data from the database
$user = $db->query("SELECT * FROM user_data WHERE id = :id", [':id' => $user_id])->findOrFail();

// Reset search count if it's a new day for the free user
if($current_date != $user['last_search_date'])
{
    $db->query("UPDATE user_data SET no_of_searches = 0, last_search_date = :current_date WHERE id = :id", [':current_date' => $current_date, ':id' => $user_id]);
    $user['no_of_searches'] = 0; // Reset the search count in the user array
}



$limit = ($user['is_paid']) ? 50 : 10; // Set the limit based on user type (paid/free)

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data (JSON)
    $json = file_get_contents('php://input');
    
    // Decode the JSON into a PHP array
    $data = json_decode($json, true); // true for associative array

    // Check if the user has exceeded the limit
    if ($user['no_of_searches'] >= $limit) {
        // Respond with limit exceeded
        header('Content-Type: application/json');
        echo json_encode([
            'limitExceed' => true, 
            'message' => 'You have reached your daily search limit.'
        ]);
        
        // Optionally, redirect to another page (e.g., payment or saved searches page)
        header('Location: /saved'); // In future, /payment for paid users
        exit();
    } else {
        // Increment the search count
        $user['no_of_searches'] += 1;
        
        // Update the search count in the database
        $db->query(
            "UPDATE user_data SET no_of_searches = :no_of_searches WHERE id = :id",
            [
                ':no_of_searches' => $user['no_of_searches'], 
                ':id' => $user['id']
            ]
        );
        
        // Respond with search success and the updated search count
        header('Content-Type: application/json');
        echo json_encode([
            'limitExceed' => false, 
            'searchCount' => $user['no_of_searches'],
            'searchData' => $data // Including the search data from the request
        ]);
        
        // Optionally, you can also return some recipes or other data in this response
        exit();
    }
}


//Check if the user has exceeded the limit
// if ($user['no_of_searches'] >= $limit) {
//     echo json_encode(['limitExceed' => true, 'message' => 'You have reached your daily search limit.']);
//     // * In future I will redirect to the payment page
//     // header('Location: /payment');
//     $limitExceed = 1;
//     header('Location: /saved');
//     exit();
// } else {    
    
//     // Increment the search count
//     $user['no_of_searches'] += 1;
//     $db->query("UPDATE user_data SET no_of_searches = :no_of_searches WHERE id = :id", ['no_of_searches' => $user['no_of_searches'], ':id' => $user_id]);
//     $data = file_get_contents("php://input");
//     dd($_POST);
//     echo json_encode(['limitExceed' => false, 'searchCount' => $user['no_of_searches'], 'data' => $data], true);
// }

$heading = "Find Recipe";

require "views/find.view.php";