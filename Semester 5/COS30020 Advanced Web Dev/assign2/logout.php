<?php
// logout.php
session_start();
session_destroy(); // Clear all session data

header('Location: index.php'); // Redirect back to the home page
exit();
