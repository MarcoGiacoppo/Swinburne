<?php
session_start();
$randomNumber = $_SESSION["randomNumber"];  // Access the random number from session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Give Up" />
    <meta name="author" content="Your Name" />
    <link rel="stylesheet" href="style.css" />
    <title>Give Up</title>
</head>

<body>
    <h1>Guessing Game - You Gave Up</h1>

    <div class="container">
        <p>The random number was: <?php echo $randomNumber; ?></p>
        <p style="color: red;">Looks like the number was too hard to guess! Don't worry, you can always try again!</p>

        <!-- Link to start the game over -->
        <p><a href="startover.php">Start Over</a></p>
    </div>

</body>

</html>