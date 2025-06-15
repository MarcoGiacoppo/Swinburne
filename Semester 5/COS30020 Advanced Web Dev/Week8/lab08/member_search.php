<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Search VIP Members" />
    <title>Search Member</title>
</head>

<body>
    <h1>Search VIP Member</h1>
    <form method="post" action="">
        <p>Last Name: <input type="text" name="lname"></p>
        <p><input type="submit" value="Search"></p>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("settings.php");

        $lname = $_POST['lname'];

        // Connect to the database
        $conn = @mysqli_connect($host, $user, $pswd, $dbnm)
            or die("Failed to connect to the database");

        // Search members by last name
        $query = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname LIKE '%$lname%'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<table border='1'>";
            echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['member_id']}</td>";
                echo "<td>{$row['fname']}</td>";
                echo "<td>{$row['lname']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No members found";
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>