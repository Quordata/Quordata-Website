<?php
session_start();

$response = array();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // User is logged in
    $response['isLoggedIn'] = true;
    $response['userID'] = $_SESSION['user_id']; // Assuming the user ID is stored in 'user_id' session variable
    $response['email'] = $_SESSION['email'];
} else {
    // User is not logged in
    $response['isLoggedIn'] = false;
    $response['userID'] = null;
    $response['email'] = '';
}

// Set the response header as JSON
header('Content-Type: application/json');
header('Vary: Cookie');

// Return the response as JSON
echo json_encode($response);
?>
