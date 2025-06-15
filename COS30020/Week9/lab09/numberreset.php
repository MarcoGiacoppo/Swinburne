<?php
session_start();                     // Start the session
session_unset();                     // Unset all session variables
session_destroy();                   // Destroy the session
header("location:number.php");       // Redirect to the main counter page
?>