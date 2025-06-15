<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About this Assignment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="postjobform.php">Post a Job Vacancy</a>
        <a href="searchjobform.php">Search for a Job Vacancy</a>
        <a href="about.php" class='active'>About this Assignment</a>
    </nav>
    <div class="container">
        <h1>About this Assignment</h1>
        <table>
            <tr>
                <th>PHP Version</th>
                <td><?php echo phpversion(); ?></td>
            </tr>
            <tr>
                <th>Tasks Not Completed</th>
                <td>None</td>
            </tr>
            <tr>
                <th>Special Features</th>
                <td>Enhanced form validation, user-friendly interface, responsive design.</td>
            </tr>
            <tr>
                <th>Discussion Board Participation</th>
                <td><img src="ss.png" width="500" height="240"></img></td>
            </tr>
        </table>
    </div>
</body>

</html>