<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Your Name" />
    <title>Car List</title>
</head>

<body>
    <h1>Web Programming - Lab08</h1>
    <?php
    require_once("settings.php");

    // Connect to the database
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm)
        or die("Failed to connect to the database");

    // Create the query
    $query = "SELECT car_id, make, model, price FROM cars";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<table border='1'>";
        echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price</th></tr>";

        // Fetch and display the results
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['car_id']}</td>";
            echo "<td>{$row['make']}</td>";
            echo "<td>{$row['model']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No records found</p>";
    }

    // Close the connection
    mysqli_close($conn);
    ?>
</body>

</html>