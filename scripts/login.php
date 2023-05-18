<?php
// Assuming you have established a database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email (required field and proper email format)
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Validate password (required field)
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    }

    // If there are no validation errors, proceed with authentication
    if (empty($errors)) {
		
        // Prepare and execute the query to check user credentials
        $query = "SELECT user_id, email, password FROM accounts WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Fetch the user row from the query result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and the password matches
        if ($user && password_verify($password, $user['password'])) {
            // Credentials are valid, create user session
            session_start();
			
			if (session_id()) {
			
				$_SESSION = array(); // Clear any existing session data
				session_regenerate_id(true); // Regenerate session ID
				
				$_SESSION['email'] = $email;
				$_SESSION['user_id'] = $user['user_id']; // Store the user ID in the session

				// Return success response to JavaScript code
				echo 'success';
			} else {
				// Failed to start login session
				echo 'Failed to start login session.';
			}
        } else {
			// Invalid credentials
			echo 'Invalid email or password.';
        }
    }
}
?>
