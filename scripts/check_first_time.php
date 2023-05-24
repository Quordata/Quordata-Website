<?php
$host = 'localhost';
$dbname = 'saddlnts_quordata';
$username = 'saddlnts';
$dbpassword = 'o*#nD*eLA2QoJ!N8VajE';

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);

    // Get the user ID from the AJAX request
    $user_id = $_POST['userID'];

    // Prepare and execute the SQL query to retrieve the current value
    $query = "SELECT FIRST_TIME FROM accounts WHERE user_id = :user_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();

    // Fetch the result
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $first_time = $result['FIRST_TIME'];

        // Use the value as needed
        if ($first_time) {
            // Update the value to false
            $updateQuery = "UPDATE accounts SET FIRST_TIME = FALSE WHERE user_id = :user_id";
            $updateStatement = $pdo->prepare($updateQuery);
            $updateStatement->bindValue(':user_id', $user_id);
            $updateStatement->execute();
        }

        echo $first_time;
    } else {
        echo "User not found.";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
