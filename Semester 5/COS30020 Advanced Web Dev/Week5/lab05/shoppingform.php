<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Form</title>
</head>

<body>
    <h1>Web Programming Form - Lab 5</h1>
    <form action="shoppingsave.php" method="post">
        <label for="item">Item:</label>
        <input type="text" id="item" name="item" required><br><br>

        <label for="qty">Quantity:</label>
        <input type="number" id="qty" name="qty" required><br><br>

        <input type="submit" value="Add to Shopping List">
    </form>
</body>

</html>