<?php
// Assuming you have established a database connection

// Check if the user ID is provided
if (isset($_GET['userID'])) {
    // Replace the placeholders with your actual database credentials
    $host = 'localhost';
    $dbname = 'saddlnts_quordata';
    $username = 'saddlnts';
    $dbpassword = 'o*#nD*eLA2QoJ!N8VajE';

    // Establish the database connection using PDO
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Database Connection Error: ' . $e->getMessage();
        exit();
    }

    // Retrieve the user ID
    $userID = $_GET['userID'];

    // Retrieve the query names based on subscribed query IDs
    $query = "SELECT email FROM accounts WHERE user_id = :userID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Fetch the user row from the query result
    $email = $stmt->fetch(PDO::FETCH_ASSOC);

	// Prepare the response as JSON
    $response = $email;
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // User ID not provided, return an error message
    echo 'User ID is missing.';
}
?>
