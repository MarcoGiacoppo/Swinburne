<?php
require_once("settings.php");

// Connect to the database
$conn = @mysqli_connect($host, $user, $pswd, $dbnm)
    or die("Failed to connect to the database");

// Select member data
$query = "SELECT member_id, fname, lname FROM vipmembers";
$result = mysqli_query($conn, $query);

echo "<h1>VIP Members</h1>";
if ($result) {
    echo "<table border='1'>";
    echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['member_id']}</td>";
        echo "<td>{$row['fname']}</td>";
        echo "<td>{$row['lname']}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No members found";
}

mysqli_close($conn);
?>