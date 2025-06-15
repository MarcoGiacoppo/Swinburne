<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Book Form</title>
</head>

<body>
    <h1>Guest Book</h1>
    <form action="guestbooksave.php" method="post">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required><br><br>

        <input type="submit" value="Sign Guest Book">
    </form>
    <br>
    <a href="guestbookshow.php">Show Guest Book</a>
</body>

</html>