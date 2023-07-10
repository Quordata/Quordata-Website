<?php
// Database credentials
$host = 'localhost';
$dbname = 'saddlnts_quordata';
$username = 'saddlnts_bcollin';
$dbpassword = 'r^isHk6xFL4G2pEoZb9k';

// User input
$userInput = $_GET['input']; // Assuming you're using GET method

// Database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the query
    $query = "SELECT name, ticker FROM companies WHERE name LIKE :input OR ticker LIKE :input LIMIT 10";
    $stmt = $pdo->prepare($query);

    // Bind the input parameter
    $stmt->bindValue(':input', "%$userInput%", PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    echo json_encode($results);
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
