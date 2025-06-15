<?php
// signup.php
require_once 'functions/db.php';
session_start();

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $profile_name = $_POST['profile_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $conn = connect_db();

    // Input validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($profile_name) || !ctype_alpha(str_replace(' ', '', $profile_name))) {
        $errors[] = "Profile name must contain only letters.";
    }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
        $errors[] = "Password must contain only letters and numbers.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM friends WHERE friend_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "Email is already registered.";
        } else {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES (?, ?, ?, CURDATE(), 0)");
            $stmt->bind_param("sss", $email, $password, $profile_name);
            if ($stmt->execute()) {
                $_SESSION['user'] = $profile_name;
                header('Location: friendadd.php');
                exit();
            } else {
                $errors[] = "Error during registration.";
            }
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>

    <main>
        <h2>Registration Page</h2>
		<form method="POST" action="signup.php">
			<!-- Retain the email input after validation failure -->
			<label>Email: <input type="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required></label><br>

			<!-- Retain the profile name input after validation failure -->
			<label>Profile Name: <input type="text" name="profile_name" value="<?= isset($profile_name) ? htmlspecialchars($profile_name) : '' ?>" required></label><br>

			<!-- Clear the password fields after validation failure -->
			<label>Password: <input type="password" name="password" required></label><br>
			<label>Confirm Password: <input type="password" name="confirm_password" required></label><br>

			<button type="submit">Register</button>
			<br>
			<button type="reset">Clear</button>
		</form>

        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($success): ?>
            <p><?= $success; ?></p>
        <?php endif; ?>
    </main>
</body>

</html>
