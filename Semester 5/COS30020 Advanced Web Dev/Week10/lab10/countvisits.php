<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP, Hit Counter" />
    <meta name="author" content="Trac Duc Anh Luong" />
    <title>Web Programming - Lab10</title>
</head>

<body>
    <?php
    require_once("hitcounter.php");

    // Set permissions for directory access
    umask(0007);

    // Define file paths
    $directory = "../../data/lab10";
    $filename = "$directory/mykeys.txt";

    // Check if directory exists
    if (!file_exists($directory)) {
        echo "<p>Directory '$directory' does not exist.</p>";
    } elseif (!file_exists($filename)) {
        echo "<p>File '$filename' does not exist.</p>";
    } else {
        // Open the file to read database connection details
        if ($handle = @fopen($filename, "r")) {
            $host = trim(fgets($handle));
            $username = trim(fgets($handle));
            $password = trim(fgets($handle));
            $dbname = trim(fgets($handle));
            fclose($handle);

            // Instantiate the HitCounter object
            $counter = new HitCounter($host, $username, $password, $dbname);

            // Retrieve and display current hit count
            $hit = $counter->getHits();
            echo "<p>This page has received $hit hits.</p>";

            // Increment the hit count and update the database
            $counter->setHits(++$hit);

            // Close the database connection
            $counter->closeConnection();
        } else {
            echo "<p>Unable to open the file '$filename'.</p>";
        }
    }
    ?>

    <p><a href="startover.php">Start Over</a></p>
</body>

</html>