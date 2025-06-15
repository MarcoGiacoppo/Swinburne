<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Marco Giacoppo" />
    <title>Web Programming - Lab10</title>
</head>

<body>
    <h1>Web Programming - Lab10</h1>
    <form method="post">
        <p>Username: <input name="username" required /></p>
        <p>Password: <input name="password" type="password" required /></p>
        <p>Database name: <input name="dbname" required /></p>
        <p>
            <input type="submit" value="Set Up" />
            <input type="reset" value="Reset" />
        </p>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $host = "feenix-mariadb.swin.edu.au";

        // Validate form inputs
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $dbname = trim($_POST["dbname"]);

        if (!empty($username) && !empty($password) && !empty($dbname)) {
            // Establish database connection
            $dbConnect = new mysqli($host, $username, $password, $dbname);
            if ($dbConnect->connect_error) {
                die("<p>Unable to connect to the database server.</p>"
                    . "<p>Error code " . $dbConnect->connect_errno
                    . ": " . $dbConnect->connect_error . "</p>");
            } else {
                // Create hitcounter table and insert initial value
                $table = "hitcounter";
                $sql1 = "CREATE TABLE IF NOT EXISTS $table ( `id` SMALLINT NOT NULL PRIMARY KEY, `hits` SMALLINT NOT NULL );";
                $sql2 = "INSERT INTO $table (id, hits) VALUES (1, 0) ON DUPLICATE KEY UPDATE hits=hits;";

                if ($dbConnect->query($sql1) && $dbConnect->query($sql2)) {
                    echo "<p>Database successfully set up.</p>";

                    // Write database connection details to a file
                    $directory = "../../data/lab10";
                    if (!file_exists($directory)) {
                        mkdir($directory, 02770, true); // Recursive directory creation
                    }

                    $filename = "$directory/mykeys.txt";
                    if ($handle = fopen($filename, "w")) {
                        $data = "$host\n$username\n$password\n$dbname\n";
                        fwrite($handle, $data);
                        fclose($handle);
                        echo "<p>Database connection details written to file.</p>";
                        echo "<p><a href='countvisits.php'>Count Visits</a></p>";
                    } else {
                        echo "<p>Unable to open the file for writing.</p>";
                    }
                } else {
                    echo "<p>Error creating or inserting into table.</p>";
                    echo "<p>Error: " . $dbConnect->error . "</p>";
                }

                $dbConnect->close();
            }
        } else {
            echo "<p>Please enter all database connection details.</p>";
        }
    }
    ?>
</body>

</html>