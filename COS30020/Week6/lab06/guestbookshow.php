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
    $filename = "../../data/lab06/guestbook.txt";

    if (file_exists($filename) && is_readable($filename)) {
        $alldata = array();

        $handle = fopen($filename, "r");
        while (!feof($handle)) {
            $line = fgets($handle);
            if ($line != "") {
                $alldata[] = explode(",", trim($line));
            }
        }
        fclose($handle);

        // Sort the array by the first element (Name)
        usort($alldata, function ($a, $b) {
            return strcmp($a[0], $b[0]);
        });

        echo "<table border='1'><tr><th>Name</th><th>Email</th></tr>";
        foreach ($alldata as $data) {
            echo "<tr><td>" . htmlspecialchars($data[0]) . "</td><td>" . htmlspecialchars($data[1]) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "The guest book is empty or cannot be read.";
    }
    ?>
    <br>
    <a href="guestbookform.php">Sign the Guest Book</a>
</body>

</html>