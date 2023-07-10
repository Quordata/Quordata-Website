<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';
include 'PHPMailer/src/Exception.php';

$errors = []; // Array to store validation errors
error_reporting(E_ALL);
ini_set('display_errors', 1);


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

				// Send email to the user
/*
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = getenv['SMTP_USERNAME'];
                $mail->Password = getenv['SMTP_PASSWORD'];
                $mail->setFrom('hello@quordata.com', 'Quordata Team');
                $mail->addAddress($email);
                $mail->Subject = 'Welcome Aboard! Your Quordata Account Registration is Complete 🚀';
                $mail->Body = "Congratulations on making your Quordata account! We're excited for you to create your first dashboard. Please reach out to us with any questions you have along the way.\n\nBest,\nQuordata Team";

                if ($mail->send()) {
                    // Redirect to success page
                    header("Location: https://quordata.com/SignUp_Success");
                    exit();
                } else {
                    // Handle email sending errors
                    $errors['email'] = 'Failed to send email.';
                }*/
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