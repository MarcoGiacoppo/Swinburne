<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Validate Position ID
    if (empty($_POST['positionID']) || !preg_match('/^ID\d{3}$/', $_POST['positionID'])) {
        $errors[] = "Position ID is required and must start with 'ID' followed by 3 digits (e.g., ID001).";
    } else {
        $positionID = $_POST['positionID'];
    }

    // Validate Title
    if (empty($_POST['title']) || !preg_match('/^[a-zA-Z0-9\s,.!]{1,10}$/', $_POST['title'])) {
        $errors[] = "Title is required and can only contain a maximum of 10 alphanumeric characters including spaces, comma, period, and exclamation point.";
    } else {
        $title = $_POST['title'];
    }

    // Validate Description
    if (empty($_POST['description']) || strlen($_POST['description']) > 250) {
        $errors[] = "Description is required and can only contain a maximum of 250 characters.";
    } else {
        $description = $_POST['description'];
    }

    // Validate Closing Date
    if (empty($_POST['closingDate']) || !preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}$/', $_POST['closingDate']) || !validateDate($_POST['closingDate'])) {
        $errors[] = "Closing Date is required and must be a valid date in the format dd/mm/yy.";
    } else {
        $closingDate = $_POST['closingDate'];
    }

    // Validate Position
    if (empty($_POST['position']) || !in_array($_POST['position'], ['Full Time', 'Part Time'])) {
        $errors[] = "Position is required and must be either 'Full Time' or 'Part Time'.";
    } else {
        $position = $_POST['position'];
    }

    // Validate Contract
    if (empty($_POST['contract']) || !in_array($_POST['contract'], ['On-going', 'Fixed term'])) {
        $errors[] = "Contract is required and must be either 'On-going' or 'Fixed term'.";
    } else {
        $contract = $_POST['contract'];
    }

    // Validate Location
    if (empty($_POST['location']) || !in_array($_POST['location'], ['On site', 'Remote'])) {
        $errors[] = "Location is required and must be either 'On site' or 'Remote'.";
    } else {
        $location = $_POST['location'];
    }

    // Validate Application Types
    if (empty($_POST['applicationType']) || !is_array($_POST['applicationType'])) {
        $errors[] = "At least one Application Type (Post, Email) is required.";
    } else {
        $applicationTypes = $_POST['applicationType'];
    }

    // If there are errors, display them to the user
    if (!empty($errors)) {
        echo "<h2>Please fix the following errors:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<br><a href='postjobform.php'>Return to Post Job Vacancy</a>";
        exit();
    }

    // Proceed with processing the data if no errors
    umask(0007);
    $dataPath = '/home/students/accounts/s104071453/cos30020/www/data/jobs';
    $filePath = $dataPath . '/positions.txt';

    if (!is_dir($dataPath)) {
        if (!mkdir($dataPath, 02770, true)) {
            die("Failed to create directory for storing job positions.<br><a href='postjobform.php'>Return to Post Job Vacancy</a>");
        }
    }

    if (file_exists($filePath)) {
        $file = fopen($filePath, 'r');
        while (!feof($file)) {
            $line = fgets($file);
            $data = explode("\t", $line);
            if ($data[0] == $positionID) {
                fclose($file);
                die("Error: Position ID '$positionID' already exists. Please use a unique ID.<br><a href='postjobform.php'>Return to Post Job Vacancy</a>");
            }
        }
        fclose($file);
    }

    $handle = fopen($filePath, 'a');
    if (!$handle) {
        die("Error: Unable to open file for writing. Please check the file permissions.<br><a href='postjobform.php'>Return to Post Job Vacancy</a>");
    }

    $record = $positionID . "\t" . $title . "\t" . $description . "\t" . $closingDate . "\t" . $position . "\t" . $contract . "\t" . $location . "\t";
    $record .= in_array('Post', $applicationTypes) ? "Post\t" : "\t";
    $record .= in_array('Email', $applicationTypes) ? "Email" : "";

    if (fwrite($handle, $record . "\n") === false) {
        fclose($handle);
        die("Error: Failed to write to file.<br><a href='postjobform.php'>Return to Post Job Vacancy</a>");
    }
    fclose($handle);

    echo "Job vacancy successfully posted!<br><a href='index.php'>Return to Home</a>";
}

// Function to validate if the date exists in the calendar
function validateDate($date, $format = 'd/m/y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
?>