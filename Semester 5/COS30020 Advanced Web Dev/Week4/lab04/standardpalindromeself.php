<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Marco Giacoppo" />
    <title>Standard Palindrome Self Check</title>
</head>

<body>
    <h1>Web Programming - Lab 4</h1>
    <form action="" method="post">
        <label for="inputString">Enter a string:</label>
        <input type="text" id="inputString" name="inputString" required>
        <input type="submit" value="Check Palindrome">
    </form>
    <?php
    if (isset($_POST["inputString"])) { // check if form data exists 
        $str = strtolower($_POST["inputString"]); // obtain the form data and convert to lowercase
        $str = str_replace([' ', ',', '.', '!', '?', '-', "'", '"'], '', $str); // remove spaces and punctuation
        $reversedStr = strrev($str); // reverse the string
        if (strcmp($str, $reversedStr) === 0) { // compare original and reversed strings
            echo "<p>'", htmlspecialchars($str), "' is a standard palindrome.</p>";
        } else {
            echo "<p>'", htmlspecialchars($str), "' is not a standard palindrome.</p>";
        }
    }
    ?>
</body>

</html>