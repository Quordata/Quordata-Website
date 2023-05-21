<?php
$host = 'localhost';
$dbname = 'saddlnts_quordata';
$username = 'saddlnts';
$dbpassword = 'o*#nD*eLA2QoJ!N8VajE';

// Get the user ID and query name from the AJAX request
$userID = $_POST['userID'];
$queryName = $_POST['query'];

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

    // Delete the subscription row from the subscriptions table
    $stmt = $conn->prepare("DELETE FROM subscriptions WHERE user_id = :userID AND query_id = :queryID");
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':queryID', $queryID);
    $stmt->execute();

    // Return a success message
    $response = 'Unsubscribed successfully';
    echo $response;
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
}
?>
