<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP, Hit Counter" />
    <meta name="author" content="Marco Giacoppo" />
    <title>Web Programming - Lab10</title>
</head>

<body>
    <h1>Hit Counter</h1>

    <?php
    require_once("hitcounter.php");

    // Set proper permissions
    umask(0007);
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
            // Read each line of the file and retrieve database connection details
            $host = trim(fgets($handle));
            $username = trim(fgets($handle));
            $password = trim(fgets($handle));
            $dbname = trim(fgets($handle));
            fclose($handle);

            // Instantiate the HitCounter object and reset the counter
            $counter = new HitCounter($host, $username, $password, $dbname);
            $counter->startOver();
            $counter->closeConnection();

            // Redirect to countvisits.php after resetting the counter
            header("Location: countvisits.php");
            exit();
        } else {
            echo "<p>Unable to open the file '$filename'.</p>";
        }
    }
    ?>

    <p><a href="startover.php">Start Over</a></p>
</body>

</html>