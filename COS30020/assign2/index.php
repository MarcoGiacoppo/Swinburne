<?php
require_once 'functions/db.php';

$conn = connect_db();

// Create the tables if they don't exist
$create_friends = "CREATE TABLE IF NOT EXISTS friends (
    friend_id INT AUTO_INCREMENT PRIMARY KEY,
    friend_email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
    profile_name VARCHAR(30) NOT NULL,
    date_started DATE NOT NULL,
    num_of_friends INT UNSIGNED DEFAULT 0
)";

$create_myfriends = "CREATE TABLE IF NOT EXISTS myfriends (
    friend_id1 INT NOT NULL,
    friend_id2 INT NOT NULL,
    PRIMARY KEY (friend_id1, friend_id2)
)";

try {
    $conn->query($create_friends);
    $conn->query($create_myfriends);

    // Check if the friends table is empty
    $result = $conn->query("SELECT COUNT(*) AS total FROM friends");
    $row = $result->fetch_assoc();

    if ($row['total'] == 0) {
        // Populate the friends table
        $conn->query("
            INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
            VALUES
            ('john@example.com', 'password123', 'John Smith', '2024-01-01', 3),
            ('jane@example.com', 'password123', 'Jane Doe', '2024-01-05', 2),
            ('sam@example.com', 'password123', 'Sam Wilson', '2024-02-01', 3),
            ('kate@example.com', 'password123', 'Kate Miller', '2024-02-05', 0),
            ('mike@example.com', 'password123', 'Mike Brown', '2024-03-01', 2),
            ('alice@example.com', 'password123', 'Alice Blue', '2024-03-05', 2),
            ('bob@example.com', 'password123', 'Bob Green', '2024-03-10', 1),
            ('charlie@example.com', 'password123', 'Charlie Red', '2024-03-12', 3),
            ('diana@example.com', 'password123', 'Diana Yellow', '2024-03-15', 1),
            ('edward@example.com', 'password123', 'Edward Brown', '2024-03-20', 1),
            ('fiona@example.com', 'password123', 'Fiona Pink', '2024-03-25', 0),
            ('george@example.com', 'password123', 'George Purple', '2024-03-28', 2),
            ('harry@example.com', 'password123', 'Harry White', '2024-03-30', 1),
            ('isla@example.com', 'password123', 'Isla Grey', '2024-04-02', 2),
            ('jack@example.com', 'password123', 'Jack Black', '2024-04-05', 0)
        ");

        // Populate the myfriends table with relationships
        $conn->query("
            INSERT INTO myfriends (friend_id1, friend_id2)
            VALUES
            (1, 2),   -- John Smith is friends with Jane Doe
            (1, 3),   -- John Smith is friends with Sam Wilson
            (1, 6),   -- John Smith is friends with Alice Blue
            (2, 3),   -- Jane Doe is friends with Sam Wilson
            (3, 4),   -- Sam Wilson is friends with Kate Miller
            (4, 5),   -- Kate Miller is friends with Mike Brown
            (6, 7),   -- Alice Blue is friends with Bob Green
            (6, 8),   -- Alice Blue is friends with Charlie Red
            (7, 8),   -- Bob Green is friends with Charlie Red
            (8, 9),   -- Charlie Red is friends with Diana Yellow
            (9, 10),  -- Diana Yellow is friends with Edward Brown
            (10, 11), -- Edward Brown is friends with Fiona Pink
            (11, 12), -- Fiona Pink is friends with George Purple
            (12, 13), -- George Purple is friends with Harry White
            (13, 14), -- Harry White is friends with Isla Grey
            (14, 15), -- Isla Grey is friends with Jack Black
            (3, 5),   -- Sam Wilson is friends with Mike Brown
            (2, 6),   -- Jane Doe is friends with Alice Blue
            (1, 10),  -- John Smith is friends with Edward Brown
            (12, 15)  -- George Purple is friends with Jack Black
        ");
    } else {
        $message = "Tables already exist and are populated.";
    }

    $message = "Tables successfully created and populated.";
} catch (Exception $e) {
    $message = "Failed to create or populate tables: " . $e->getMessage();
    echo $message;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Friend System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
	    <div class="nav-content">
	        <h1>My Friend System</h1>
	        <ul>
				<li><a href="signup.php">Sign Up</a></li>
				<li><a href="login.php">Log In</a></li>
				<li><a href="about.php">About</a></li>
	        </ul>
	    </div>
	</nav>

	<main>
	    <h2>Assignment Home Page</h2>

	    <!-- Table-like structure for assignment details -->
	    <div class="details-table">
	        <div class="label">Name:</div>
	        <div class="value">Marco Giacoppo</div>

	        <div class="label">Student ID:</div>
	        <div class="value">104071453</div>

	        <div class="label">Email:</div>
	        <div class="value">104071453@swin.edu.au</div>

	        <div class="label">Statement:</div>
	        <div class="value">I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student's work or any other source.</div>
	    </div>

	    <p><?= $message; ?></p>
	</main>
    
</body>
</html>
