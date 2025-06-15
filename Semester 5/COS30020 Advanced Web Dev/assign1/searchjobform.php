<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Job Vacancy</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="postjobform.php">Post a Job Vacancy</a>
        <a href="searchjobform.php" class='active'>Search for a Job Vacancy</a>
        <a href="about.php">About this Assignment</a>
    </nav>
    <div class="container">
        <h1>Search Job Vacancy</h1>
        <form action="searchjobprocess.php" method="get">
            <table>
                <tr>
                    <th><label for="title">Job Title:</label></th>
                    <td><input type="text" id="title" name="title"></td>
                </tr>
                <tr>
                    <th>Position:</th>
                    <td>
                        <input type="radio" id="fullTime" name="position" value="Full Time">
                        <label for="fullTime">Full Time</label>
                        <input type="radio" id="partTime" name="position" value="Part Time">
                        <label for="partTime">Part Time</label>
                    </td>
                </tr>
                <tr>
                    <th>Contract:</th>
                    <td>
                        <input type="radio" id="ongoing" name="contract" value="On-going">
                        <label for="ongoing">On-going</label>
                        <input type="radio" id="fixedTerm" name="contract" value="Fixed term">
                        <label for="fixedTerm">Fixed term</label>
                    </td>
                </tr>
                <tr>
                    <th>Application Type:</th>
                    <td>
                        <input type="radio" id="post" name="applicationType" value="Post">
                        <label for="post">Post</label>
                        <input type="radio" id="email" name="applicationType" value="Email">
                        <label for="email">Email</label>
                    </td>
                </tr>
                <tr>
                    <th>Location:</th>
                    <td>
                        <input type="radio" id="onSite" name="location" value="On site">
                        <label for="onSite">On site</label>
                        <input type="radio" id="remote" name="location" value="Remote">
                        <label for="remote">Remote</label>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Search">
        </form>
    </div>
</body>

</html>