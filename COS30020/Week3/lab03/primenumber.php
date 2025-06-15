<?php
function is_prime($number)
{
    if ($number <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) { // Loop from 2 to the sqr root of the number
        if ($number % $i == 0) { // check if its divisible by i
            return false; // If it is, it's not a prime number
        }
    }
    return true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Lab 3" />
    <meta name="keywords" content="Web,programming" />
    <title>Prime Number Check</title>
</head>

<body>
    <?php
    if (isset($_GET["number"])) {
        $num = $_GET["number"];
        if (is_numeric($num) && $num > 0 && $num == round($num)) {
            if (is_prime($num)) {
                echo "<p>$num is a prime number.</p>";
            } else {
                echo "<p>$num is not a prime number.</p>";
            }
        } else {
            echo "<p>Please enter a positive integer.</p>";
        }
    } else {
        echo "<p>Please enter a number.</p>";
    }
    ?>
</body>

</html>