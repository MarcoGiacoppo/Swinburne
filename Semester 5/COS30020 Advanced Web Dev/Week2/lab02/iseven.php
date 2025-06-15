<?php
// Check if the 'number' parameter is set in the URL
if (isset($_GET['number'])) {
    // Retrieve the value from the URL and store it in a variable
    $value = $_GET['number'];

    // Check if the variable contains a number
    if (is_numeric($value)) {
        // Convert the value to the nearest whole number
        $number = round($value);

        // Use a conditional operator to check if the number is even
        $message = ($number % 2 == 0) ? "The number $number is even." : "The number $number is odd.";
    } else {
        $message = "The value is not a number.";
    }
} else {
    $message = "No number provided.";
}

// Display the message
echo $message;
?>