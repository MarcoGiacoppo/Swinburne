<?php
function connect_db()
{
    $servername = 'feenix-mariadb.swin.edu.au';
    $username = 's104071453';
    $password = 'b2e96xwh3r';
    $dbname = 's104071453_db';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>