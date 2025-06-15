<?php
session_start();

// Check if random number is already set
if (!isset($_SESSION["randomNumber"])) {
    $_SESSION["randomNumber"] = rand(0, 100);  // Generate a random number
    $_SESSION["attempts"] = 0;                 // Reset the number of attempts
}

// Process the guess if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $guess = $_POST["guess"];                  // Get the user's guess
        $_SESSION["attempts"]++;                   // Increment the attempt counter

        // Check if the guess is numeric
        if (is_numeric($guess)) {
            if ($guess > $_SESSION["randomNumber"]) {
                $message = "Too high!";            // Guess is too high
                $messageColor = "#333";            // Default color for normal feedback
            } elseif ($guess < $_SESSION["randomNumber"]) {
                $message = "Too low!";             // Guess is too low
                $messageColor = "#333";            // Default color for normal feedback
            } else {
                $message = "Congratulations! You guessed the correct number!";  // Correct guess
                $messageColor = "green";           // Green color for winning message
            }
        } else {
            $message = "Please enter a valid number.";  // Invalid input
            $messageColor = "#f00";                    // Red color for error
        }
    } catch (Exception $e) {
        $message = "An error occurred: " . $e->getMessage();  // Handle any exceptions
        $messageColor = "#f00";  // Red color for errors
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Guessing Game" />
    <meta name="author" content="Your Name" />
    <link rel="stylesheet" href="style.css" />
    <title>Guessing Game</title>
</head>

<body>
    <h1>Guessing Game</h1>

    <div class="container">
        <?php
        // Display feedback message if available with appropriate color
        if (isset($message))
            echo "<p style='color: $messageColor;'>$message</p>";
        ?>

        <!-- Form for user to input guess -->
        <form method="post" action="">
            <label for="guess">Enter your guess (between 0 and 100):</label>
            <input type="number" name="guess" min="0" max="100" required>
            <input type="submit" value="Submit Guess">
        </form>

        <!-- Display the number of attempts -->
        <p>Attempts: <?php echo $_SESSION["attempts"]; ?></p>

        <!-- Links for 'Give Up' and 'Start Over' -->
        <p><a href="giveup.php">Give Up</a></p>
        <p><a href="startover.php">Start Over</a></p>
    </div>

</body>

</html>