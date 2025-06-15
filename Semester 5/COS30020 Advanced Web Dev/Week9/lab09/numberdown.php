<?php
session_start();                     // Start the session
$num = $_SESSION["number"];          // Copy the value to a variable
$num--;                              // Decrement the value
$_SESSION["number"] = $num;          // Update the session variable
header("location:number.php");       // Redirect to the main counter page
?>