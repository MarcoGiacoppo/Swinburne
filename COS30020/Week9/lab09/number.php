<?php
session_start();                     // Start the session
if (!isset($_SESSION["number"])) {   // Check if session variable exists
    $_SESSION["number"] = 0;           // Create the session variable if it doesn't exist
}
$num = $_SESSION["number"];          // Copy the value to a variable
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Your Name" />
    <link rel="stylesheet" href="style.css" /> <!-- Link to external CSS file -->
    <title>Number Counter</title>
</head>

<body>
    <h1>Web Programming - Lab09</h1>
    <div class="container">
        <?php
        // Display the number
        echo "<p>The number is $num</p>";
        ?>
        <!-- Links for increment, decrement, and reset -->
        <p><a href="numberup.php">Up</a></p>
        <p><a href="numberdown.php">Down</a></p>
        <p><a href="numberreset.php">Reset</a></p>
    </div>
</body>

</html>