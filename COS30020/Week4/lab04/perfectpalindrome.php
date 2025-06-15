<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Marco Giacoppo" />
    <title>Perfect Palindrome Check</title>
</head>

<body>
    <h1>Web Programming - Lab 4</h1>
    <?php
    if (isset($_POST["inputString"])) { // check if form data exists 
        $str = strtolower($_POST["inputString"]); // obtain the form data and convert to lowercase
        $reversedStr = strrev($str); // reverse the string
        if (strcmp($str, $reversedStr) === 0) { // compare original and reversed strings
            echo "<p>'", htmlspecialchars($str), "' is a perfect palindrome.</p>";
        } else {
            echo "<p>'", htmlspecialchars($str), "' is not a perfect palindrome.</p>";
        }
    } else { // no input 
        echo "<p>Please enter a string from the input form.</p>";
    }
    ?>
</body>

</html>