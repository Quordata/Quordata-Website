<?php
session_start();

// Clear all session data
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other appropriate location
header("Location: https://quordata.com/Home");
exit();
?>
