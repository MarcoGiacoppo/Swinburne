<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Save</title>
</head>

<body>
    <h1>Web Programming - Lab06</h1>
    <?php
    if (isset($_POST["item"]) && isset($_POST["qty"])) { // Check if both form data exists
        $item = $_POST["item"]; // Obtain the form item data
        $qty = $_POST["qty"];  // Obtain the form quantity data
        $filename = "../../data/shop.txt"; // Path to the shop.txt file
    
        $alldata = array(); // Create an empty array
        $itemdata = array(); // Create an empty array for item names
    
        if (file_exists($filename)) { // Check if the file exists for reading
            $handle = fopen($filename, "r"); // Open the file in read mode
    
            while (!feof($handle)) { // Loop while not end of file
                $onedata = fgets($handle); // Read a line from the text file
                if ($onedata != "") { // Ignore blank lines
                    $data = explode(",", trim($onedata)); // Split the line into an array
                    $alldata[] = $data; // Add the data to the main array
                    $itemdata[] = $data[0]; // Add the item name to the item array
                }
            }
            fclose($handle); // Close the text file
    
            $newdata = !in_array($item, $itemdata); // Check if the item exists in the array
        } else {
            $newdata = true; // If the file does not exist, it's new data
        }

        if ($newdata) {
            $handle = fopen($filename, "a"); // Open the file in append mode
            $data = $item . "," . $qty . "\n"; // Concatenate item and qty delimited by comma
            fputs($handle, $data); // Write the string to the text file
            fclose($handle); // Close the text file
    
            $alldata[] = array($item, $qty); // Add the new data to the array
    
            echo "<p>Shopping item added</p>";
        } else {
            echo "<p>Shopping item already exists</p>";
        }

        // Sort the array elements alphabetically by the item name
        usort($alldata, function ($a, $b) {
            return strcmp($a[0], $b[0]);
        });

        echo "<p>Shopping List</p>";
        foreach ($alldata as $data) { // Loop through the sorted array and display the items
            echo "<p>", htmlspecialchars($data[0]), " -- ", htmlspecialchars($data[1]), "</p>";
        }
    } else { // No input
        echo "<p>Please enter item and quantity in the input form.</p>";
    }
    ?>
</body>

</html>