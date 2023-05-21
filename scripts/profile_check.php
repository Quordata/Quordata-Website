<?php
    if (session_status() === PHP_SESSION_NONE) {
		// Start the session
		session_start();
	}
    // Check if the user is not logged in
    if (!isset($_SESSION['email'])) {
        // Redirect the user to the login page or display an access denied message
        header("Location: Login_Page.html");
        exit();
    } else {		
		// User is logged in
		echo 'logged_in';
	}
?>