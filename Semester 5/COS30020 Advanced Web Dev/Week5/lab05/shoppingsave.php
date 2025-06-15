<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Save</title>
</head>

<body>
    <h1>Web Programming - Lab 5</h1>
    <?php
    if (isset($_POST["item"]) && isset($_POST["qty"])) { // Check if both form data exists
        $item = $_POST["item"]; // Obtain the form item data
        $qty = $_POST["qty"];  // Obtain the form quantity data
        $filename = "../../data/shop.txt"; // Path to the shop.txt file
        $handle = fopen($filename, "a"); // Open the file in append mode
        $data = $item . "," . $qty . PHP_EOL; // Concatenate item and qty delimited by comma
        fwrite($handle, $data); // Write string to text file
        fclose($handle); // Close the text file
    
        echo "<p>Shopping List</p>"; // Generate shopping list
        $handle = fopen($filename, "r"); // Open the file in read mode
    
        while (!feof($handle)) { // Loop while not end of file
            $data = fgets($handle); // Read a line from the text file
            echo "<p>" . htmlspecialchars($data) . "</p>"; // Generate HTML output of the data
        }
        fclose($handle); // Close the text file
    } else { // No input
        echo "<p>Please enter item and quantity in the input form.</p>";
    }
    ?>
</body>

</html>