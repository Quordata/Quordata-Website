<?php
// Assuming you have established a database connection

// Check if the user ID is provided
if (isset($_GET['userID'])) {
    // Replace the placeholders with your actual database credentials
    $host = 'localhost';
	$dbname = 'saddlnts_quordata';
	$username = 'saddlnts_bcollin';
	$dbpassword = 'r^isHk6xFL4G2pEoZb9k';

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
    $query = "SELECT q.name FROM queries q
              JOIN subscriptions s ON q.query_id = s.query_id
              WHERE s.user_id = :userID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Fetch the query names from the query result
    $queryNames = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Prepare the response as JSON
    $response = array('queryNames' => $queryNames);
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // User ID not provided, return an error message
    echo 'User ID is missing.';
}
?>
