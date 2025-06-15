<?php
// Step 1: Declare and initialize the array with the days of the week in English
$days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

// Display the days of the week in English
echo "The days of the week in English are:<br> ";
foreach ($days as $day) {
    echo $day . " ";
}
echo "<br>";

// Step 3: Reassign the values in the $days array with the days of the week in French
$days = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

// Display the days of the week in French
echo "<br>The days of the week in French are:<br> ";
foreach ($days as $day) {
    echo $day . " ";
}
?>