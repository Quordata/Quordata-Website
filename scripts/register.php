<?php
$errors = []; // Array to store validation errors

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and sanitize inputs
    $email = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $confirmPassword = htmlspecialchars($_POST['repassword'], ENT_QUOTES, 'UTF-8');


    // Validate email (required field and proper email format)
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Validate password (required field and minimum complexity requirements)
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*_])[A-Za-z\d!@#$%^&*_]{8,}$/", $password)) {
        $errors['password'] = 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.';
    }

    // Validate confirm password (required field and match with password)
    if (empty($confirmPassword)) {
        $errors['password_reinput'] = 'Confirm password is required.';
    } elseif ($password !== $confirmPassword) {
        $errors['password_reinput'] = 'Passwords do not match.';
    }

    // If there are no validation errors, process the form data
    if (empty($errors)) {
        // Perform further processing or database operations

		// Establish database connection
		$host = 'localhost';
		$dbname = 'saddlnts_quordata';
		$username = 'saddlnts';
		$dbpassword = 'o*#nD*eLA2QoJ!N8VajE';

		try {
		    // Establish database connection
		    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
		    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  
		    // Check if email already exists
            $query = "SELECT COUNT(*) FROM accounts WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $errors['email'] = 'Email is already registered.';
            } else {
				
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

				// Insert user into the accounts table
				$query = "INSERT INTO accounts (email, password) VALUES (:email, :password)";
				$stmt = $db->prepare($query);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':password', $hashedPassword);
				$stmt->execute();

				// Redirect to success page
				header("Location: https://quordata.com/SignUp_Success");
				exit();
			}
		} catch (PDOException $e) {
		  // Handle database connection errors or other errors
		  echo 'Registration Error: ' . $e->getMessage();
		}
    }
}
?>