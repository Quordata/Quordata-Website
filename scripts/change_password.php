<?php
session_start();

if (isset($_SESSION['user_id'])) {
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

    // Retrieve the user ID and new password from the form submission
    $userID = $_SESSION['user_id'];
    $newPassword = $_POST['password'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the accounts table
    $query = "UPDATE accounts SET password = :password WHERE user_id = :userID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Redirect to a success page or perform any other actions
    header("Location: https://quordata.com/My_Profile");
    exit();
} else {
    exit();
}
?>
