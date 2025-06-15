<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Book</title>
</head>

<body>
    <h1>Guest Book Entries</h1>
    <?php
    $filename = "../../data/lab05/guestbook.txt";

    if (is_readable($filename)) {
        $contents = file_get_contents($filename); // Read the file content
        $contents = stripslashes($contents); // Unescape any characters
        echo "<pre>" . htmlspecialchars($contents) . "</pre>"; // Display content within <pre> tags
    } else {
        echo "The guest book is empty or cannot be read.";
    }
    ?>
    <br>
    <a href="guestbookform.php">Sign the Guest Book</a>
</body>

</html>