<?php
function is_leapyear($year)
{
    if ($year % 4 == 0) {
        if ($year % 100 == 0) {
            if ($year % 400 == 0) {
                return true; // divisible by 400, so yes leap year
            } else {
                return false; // divisible by 100 but not by 400
            }
        } else {
            return true; // divisible by 4 but not by 100
        }
    } else {
        return false; // not divisible by 4
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Lab 3" />
    <meta name="keywords" content="Web,programming" />
    <title>Leap Year Check</title>
</head>

<body>
    <?php
    if (isset($_GET["year"])) {
        $year = $_GET["year"];
        if (is_numeric($year)) {
            if (is_leapyear($year)) {
                echo "<p>$year is a leap year.</p>";
            } else {
                echo "<p>$year is not a leap year.</p>";
            }
        } else {
            echo "<p>Please enter a valid year.</p>";
        }
    } else {
        echo "<p>Please enter a year.</p>";
    }
    ?>
</body>

</html>