<?php
// login.php
require_once 'functions/db.php';
session_start();

$errors = [];
$email = '';  // Initialize email to retain it after form submission

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = connect_db();

    // Check if the email exists
    $stmt = $conn->prepare("SELECT * FROM friends WHERE friend_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check if the password matches
        if ($user['password'] === $password) {
            $_SESSION['user'] = $user['profile_name'];  // Store profile name in session
            header('Location: friendlist.php');
            exit();
        } else {
            // Incorrect password
            $errors[] = "Incorrect password.";
        }
    } else {
        // Email not found
        $errors[] = "Email does not exist.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>

    <main>
        <h2>Login Page</h2>
        <form method="POST" action="login.php">
            <!-- Retain the email input after validation failure -->
            <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required></label><br>

            <!-- Clear the password field after validation failure -->
            <label>Password: <input type="password" name="password" required></label><br>

            <button type="submit">Log In</button>
        </form>

        <!-- Display errors if there are any -->
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>

</html>
