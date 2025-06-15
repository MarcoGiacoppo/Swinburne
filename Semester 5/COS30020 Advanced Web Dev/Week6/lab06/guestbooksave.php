<?php
umask(0007); // Set umask to control default file permissions when creating files and directories

$dir = "../../data/lab06"; // Define the path to the directory where the guestbook file will be stored

// Check if the directory exists, and if not, create it with the specified permissions
if (!is_dir($dir)) {
    mkdir($dir, 02770, true); // Create the 'lab06' directory with read/write/execute permissions for the owner and group, and read/execute for others
}

// Check if both 'name' and 'email' fields are provided via POST request
if (isset($_POST["name"]) && isset($_POST["email"])) {
    // Escape any special characters in the name to prevent issues with file writing or security vulnerabilities
    $name = addslashes($_POST["name"]);
    // Escape any special characters in the email for the same reasons as above
    $email = addslashes($_POST["email"]);

    $filename = $dir . "/guestbook.txt";

    $alldata = array(); // Initialize an empty array to store all existing guest data from the file
    $exists = false; // A flag to check if the name or email already exists in the guestbook

    // Check if the guestbook file already exists
    if (file_exists($filename)) {
        // Open the guestbook file in read mode
        $handle = fopen($filename, "r");
        // Loop through each line of the file until the end of the file is reached
        while (!feof($handle)) {
            $line = fgets($handle); // Read a line from the file
            if ($line != "") { // Only process the line if it is not empty
                // Split the line into name and email using a comma as the delimiter
                $data = explode(",", trim($line));
                // Check if the name or email from the POST request already exists in the file
                if ($data[0] == $name || $data[1] == $email) {
                    $exists = true; // Set the flag to true if a match is found
                    break; // Exit the loop since no further checking is needed
                }
                // Add the existing data from the file to the $alldata array
                $alldata[] = $data;
            }
        }
        fclose($handle); // Close the file after reading
    }

    // If the name or email does not already exist in the guestbook
    if (!$exists) {
        // Open the guestbook file in append mode
        $handle = fopen($filename, "a");
        // Prepare the new guest's data as a comma-separated string
        $data = $name . "," . $email . "\n";
        // Write the new guest's data to the file
        fputs($handle, $data);
        fclose($handle); // Close the file after writing
        echo "Thank you for signing the Guest Book.<br>"; // Provide feedback to the user
    } else {
        // If the name or email already exists, notify the user
        echo "This name or email is already in the Guest Book.<br>";
    }
} else {
    // If either name or email was not provided, prompt the user to enter both
    echo "Please enter both your name and email.<br>";
}
?>

<!-- Provide a link for the user to go back to the guestbook form -->
<a href="guestbookform.php">Go Back</a>