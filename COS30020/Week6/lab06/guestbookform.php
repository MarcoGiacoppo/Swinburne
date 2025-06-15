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
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Sign Guest Book">
    </form>
    <br>
    <a href="guestbookshow.php">View Guest Book</a>
</body>

</html>