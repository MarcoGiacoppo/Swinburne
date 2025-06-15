<?php
umask(0007); // Set umask for directory permissions
$dir = "../../data/lab05";
if (!is_dir($dir)) {
    mkdir($dir, 02770, true); // Create the 'lab05' directory if it doesn't exist
}

if (isset($_POST["firstname"]) && isset($_POST["lastname"])) { // Check if both names are provided
    $firstname = addslashes($_POST["firstname"]); // Escape any special characters in first name
    $lastname = addslashes($_POST["lastname"]);
    $filename = $dir . "/guestbook.txt";
    $handle = fopen($filename, "a"); // Open the file in append mode

    if ($handle) {
        $data = $firstname . " " . $lastname . PHP_EOL; // Combine names with a space and newline
        fwrite($handle, $data); // Write the full name to the file
        fclose($handle); // Close the file
        echo "Thank you for signing the Guest Book.<br>";
    } else {
        echo "Cannot add your name to the Guest Book.<br>";
    }
} else {
    echo "Please enter both your first and last name.<br>";
}
?>
<a href="guestbookform.php">Go Back</a>