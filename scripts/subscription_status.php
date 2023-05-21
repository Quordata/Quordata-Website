<?php
$host = 'localhost';
$dbname = 'saddlnts_quordata';
$username = 'saddlnts';
$dbpassword = 'o*#nD*eLA2QoJ!N8VajE';

// Get the user ID from the AJAX request
$userID = $_GET['userID'];

// Get the query name from the AJAX request
$queryName = $_GET['queryName'];

// Connect to the database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the query ID based on the query name
    $stmt = $conn->prepare("SELECT query_id FROM queries WHERE name = :queryName");
    $stmt->bindParam(':queryName', $queryName);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $queryID = $row['query_id'];

    // Check if the user is subscribed to the query
    $stmt = $conn->prepare("SELECT COUNT(*) AS subscriptionCount FROM subscriptions WHERE user_id = :userID AND query_id = :queryID");
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':queryID', $queryID);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $isSubscribed = ($row['subscriptionCount'] > 0);

    // Return the subscription status as JSON
    $response = array('isSubscribed' => $isSubscribed);
    header('Content-Type: application/json');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
}
?>
