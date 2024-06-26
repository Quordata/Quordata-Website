<?php
// Establish database connection
$host = 'localhost';
$dbname = 'saddlnts_quordata';
$username = 'saddlnts';
$dbpassword = 'o*#nD*eLA2QoJ!N8VajE';

try {
    // Establish database connection
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the query from the JavaScript input
    $query = $_POST['query'];

    // Retrieve the user ID from the JavaScript input
    $userID = $_POST['userID'];

    // Retrieve the query ID from the queries table
    $queryID = null;
    $queryCheck = "SELECT query_id FROM queries WHERE name = '$query'";
    $queryResult = $db->query($queryCheck);
    if ($queryResult && $queryResult->rowCount() > 0) {
        $row = $queryResult->fetch(PDO::FETCH_ASSOC);
        $queryID = $row['query_id'];
    } else {
        // Query does not exist, add it to the queries table
        $insertQuery = "INSERT INTO queries (name) VALUES ('$query')";
        $insertResult = $db->exec($insertQuery);

        if ($insertResult) {
            $queryID = $db->lastInsertId(); // Get the newly inserted query ID
        }
    }

    if ($queryID !== null) {
        // Check if the subscription already exists in the subscriptions table
        $subscriptionCheck = "SELECT * FROM subscriptions WHERE user_id = '$userID' AND query_id = '$queryID'";
        $subscriptionResult = $db->query($subscriptionCheck);
        if ($subscriptionResult && $subscriptionResult->rowCount() > 0) {
            // Subscription already exists, do nothing
            echo "Subscription already exists.";
        } else {
            // Insert the subscription into the subscriptions table
            $subscriptionInsert = "INSERT INTO subscriptions (user_id, query_id) VALUES ('$userID', '$queryID')";
            $subscriptionResult = $db->exec($subscriptionInsert);
            if ($subscriptionResult) {
                // Subscription inserted successfully
                echo "Subscription added successfully.";
            } else {
                // Error inserting subscription
                echo "Error adding subscription.";
            }
        }
    } else {
        // Query not found in the queries table
        echo "Query not found.";
    }
} catch (PDOException $e) {
    // Handle database connection errors or other errors
    echo 'Registration Error: ' . $e->getMessage();
}
?>
