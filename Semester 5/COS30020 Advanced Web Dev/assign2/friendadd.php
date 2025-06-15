<?php
// friendadd.php
require_once 'functions/db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$profile_name = $_SESSION['user'];
$conn = connect_db();

// Get logged-in user details
$stmt = $conn->prepare("SELECT friend_id FROM friends WHERE profile_name = ?");
$stmt->bind_param("s", $profile_name);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['friend_id'];

// Handle "Add Friend" action
if (isset($_GET['add_friend_id'])) {
    $friend_id = (int) $_GET['add_friend_id'];

    // Check if already friends
    $stmt = $conn->prepare("SELECT * FROM myfriends WHERE friend_id1 = ? AND friend_id2 = ?");
    $stmt->bind_param("ii", $user_id, $friend_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        // Add the friend if not already added
        $stmt = $conn->prepare("INSERT INTO myfriends (friend_id1, friend_id2) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $friend_id);
        $stmt->execute();

        // Update the friend's friend count
        $stmt = $conn->prepare("UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = ?");
        $stmt->bind_param("i", $friend_id);
        $stmt->execute();

        // Update user's friend count
        $stmt = $conn->prepare("UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    }

    // Redirect back to avoid re-adding on page refresh
    header('Location: friendadd.php');
    exit();
}

// Get the IDs of the user's current friends
$friend_ids = [];
$stmt = $conn->prepare("SELECT friend_id2 FROM myfriends WHERE friend_id1 = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$friends_result = $stmt->get_result();
while ($row = $friends_result->fetch_assoc()) {
    $friend_ids[] = $row['friend_id2'];
}

// Convert array of friend IDs to a string for SQL query
$friend_ids_str = implode(",", $friend_ids);

// Pagination
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$records_per_page = 10;
$offset = ($page - 1) * $records_per_page;

// Query for potential friends who are not the user's current friends
if (!empty($friend_ids)) {
    $query = "SELECT * FROM friends WHERE friend_id != ? AND friend_id NOT IN ($friend_ids_str) LIMIT ?, ?";
} else {
    // In case there are no current friends, just exclude the user themselves
    $query = "SELECT * FROM friends WHERE friend_id != ? LIMIT ?, ?";
}

$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $user_id, $offset, $records_per_page);
$stmt->execute();
$potential_friends = $stmt->get_result();

// Count the total number of potential friends for pagination
if (!empty($friend_ids)) {
    $count_query = "SELECT COUNT(*) AS total FROM friends WHERE friend_id != ? AND friend_id NOT IN ($friend_ids_str)";
} else {
    $count_query = "SELECT COUNT(*) AS total FROM friends WHERE friend_id != ?";
}
$stmt = $conn->prepare($count_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$count_result = $stmt->get_result();
$total_records = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Friends</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<nav>
	    <div class="nav-content">
	        <h1>Welcome Back, <?= htmlspecialchars($profile_name); ?> !</h1>
	        <ul>
	            <li><a href="friendlist.php">Friend List</a></li>
	            <li><a href="logout.php">Log Out</a></li>
	        </ul>
	    </div>
	</nav>
 
    <main>
		<h2>Add Friend Page</h2>
		<h2><br>Total number of friends: <?= $friends_result->num_rows; ?></h2>
        <ul class="content-list">
            <?php while ($friend = $potential_friends->fetch_assoc()): ?>
                <?php
                // Get mutual friend count
                $stmt = $conn->prepare("
                    SELECT COUNT(*) AS mutual_count 
                    FROM myfriends mf1 
                    INNER JOIN myfriends mf2 ON mf1.friend_id2 = mf2.friend_id2 
                    WHERE mf1.friend_id1 = ? AND mf2.friend_id1 = ?");
                $stmt->bind_param("ii", $user_id, $friend['friend_id']);
                $stmt->execute();
                $mutual_result = $stmt->get_result();
                $mutual_count = $mutual_result->fetch_assoc()['mutual_count'];
                ?>

                <li>
                    <?= htmlspecialchars($friend['profile_name']); ?>
                    (<?= $mutual_count; ?> mutual friends)
                    <a href="friendadd.php?add_friend_id=<?= $friend['friend_id']; ?>">Add as Friend</a>
                </li>
            <?php endwhile; ?>
        </ul>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="friendadd.php?page=<?= $page - 1; ?>">Previous</a>
            <?php endif; ?>
            <?php if ($page < $total_pages): ?>
                <a href="friendadd.php?page=<?= $page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>