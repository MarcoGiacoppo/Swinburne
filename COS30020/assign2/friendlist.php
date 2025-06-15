<?php
// friendlist.php
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

// Handle "Unfriend" action
if (isset($_GET['unfriend_id'])) {
    $unfriend_id = (int) $_GET['unfriend_id'];

    // Remove the friend relationship from both directions
    $stmt = $conn->prepare("DELETE FROM myfriends WHERE (friend_id1 = ? AND friend_id2 = ?) OR (friend_id1 = ? AND friend_id2 = ?)");
    $stmt->bind_param("iiii", $user_id, $unfriend_id, $unfriend_id, $user_id);
    $stmt->execute();

    // Update friend counts
    $stmt = $conn->prepare("UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt->bind_param("i", $unfriend_id);
    $stmt->execute();

    // Redirect to avoid accidental re-submissions
    header('Location: friendlist.php');
    exit();
}

// Get the user's friends
$stmt = $conn->prepare("
    SELECT f.friend_id, f.profile_name
    FROM friends f
    INNER JOIN myfriends m ON f.friend_id = m.friend_id2
    WHERE m.friend_id1 = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$friends_result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Friend List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<nav>
	    <div class="nav-content">
	        <h1>Welcome Back, <?= htmlspecialchars($profile_name); ?> !</h1>
	        <ul>
	            <li><a href="friendadd.php">Add Friends</a></li>
	            <li><a href="logout.php">Log Out</a></li>
	        </ul>
	    </div>
	</nav>

    <main>
		<h2><?= htmlspecialchars($profile_name); ?>'s Friend List</h2>
        <h2><br>Total number of friends: <?= $friends_result->num_rows; ?></h2>

        <ul class="content-list">
            <?php while ($friend = $friends_result->fetch_assoc()): ?>
                <li>
                    <?= htmlspecialchars($friend['profile_name']); ?>
                    <a href="friendlist.php?unfriend_id=<?= $friend['friend_id']; ?>">Unfriend</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </main>
</body>

</html>