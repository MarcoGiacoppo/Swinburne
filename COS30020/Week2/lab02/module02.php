<?php
// Declare and initialize the array with the given elements
$marks = [85, 85, 95];

// Modify the value of the second element to 90
$marks[1] = 90;

// Compute the average score
$ave = array_sum($marks) / count($marks);

// Determine the status using the ?: operator
$status = ($ave >= 50) ? "PASSED" : "FAILED";

// Display the average score and the status
echo "The average score is " . $ave . ". You " . $status . ".";
?>