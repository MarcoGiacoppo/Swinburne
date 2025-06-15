<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Marco Giacoppo" />
    <title>String Processing</title>
</head>

<body>
    <h1>Web Programming - Lab 4</h1>
    <?php
    if (isset($_POST["inputString"])) { // check if form data exists 
        $str = $_POST["inputString"]; // obtain the form data 
        $pattern = "/^[A-Za-z ]+$/"; // set regular expression pattern 
        if (preg_match($pattern, $str)) { // check if $str matches the pattern 
            $ans = ""; // initialise variable for the answer 
            $len = strlen($str); // obtain length of string $str 
            for ($i = 0; $i < $len; $i++) { // checks all characters in $str 
                $letter = substr($str, $i, 1); // extract 1 char using substr  
                if (strpos("AEIOUaeiou", $letter) === false) { // check if character is not a vowel
                    $ans .= $letter; // concatenate letter to answer 
                }
            }
            // generate answer after all letters are checked 
            echo "<p>The word with no vowels are ", htmlspecialchars($ans), ".</p>";
        } else { // string contains invalid characters 
            echo "<p>Please enter a string containing only letters or spaces.</p>";
        }
    } else { // no input 
        echo "<p>Please enter a string from the input form.</p>";
    }
    ?>
</body>

</html>