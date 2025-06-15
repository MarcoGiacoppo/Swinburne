<?php
require_once("settings.php");

// Connect to the database
$conn = @mysqli_connect($host, $user, $pswd, $dbnm)
    or die("Failed to connect to the database");

// Create the 'vipmembers' table if it doesn't exist
$table = "CREATE TABLE IF NOT EXISTS vipmembers (
            member_id INT AUTO_INCREMENT PRIMARY KEY,
            fname VARCHAR(40),
            lname VARCHAR(40),
            gender VARCHAR(1),
            email VARCHAR(40),
            phone VARCHAR(20)
        )";

mysqli_query($conn, $table);

// Insert new member data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$insert = "INSERT INTO vipmembers (fname, lname, gender, email, phone)
           VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";

if (mysqli_query($conn, $insert)) {
    echo "New member added successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>