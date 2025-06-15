<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Job Vacancy</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="postjobform.php" class="active">Post a Job Vacancy</a>
        <a href="searchjobform.php">Search for a Job Vacancy</a>
        <a href="about.php">About this Assignment</a>
    </nav>
    <div class="container">
        <h1>Post Job Vacancy</h1>
        <form action="postjobprocess.php" method="post">
            <table>
                <tr>
                    <th><label for="positionID">Position ID:</label></th>
                    <td><input type="text" id="positionID" name="positionID" pattern="^ID\d{3}$" maxlength="5"
                            placeholder="e.g., ID001"></td>
                </tr>
                <tr>
                    <th><label for="title">Title:</label></th>
                    <td><input type="text" id="title" name="title" pattern="^[a-zA-Z0-9\s,.!]{1,10}$" maxlength="10"
                            placeholder="e.g., IT Manager"></td>
                </tr>
                <tr>
                    <th><label for="description">Description:</label></th>
                    <td><textarea id="description" name="description" maxlength="250"
                            placeholder="Enter the job description (max 250 characters)"></textarea></td>
                </tr>
                <tr>
                    <th><label for="closingDate">Closing Date:</label></th>
                    <td><input type="text" id="closingDate" name="closingDate" value="<?php echo date('d/m/y'); ?>"
                            pattern="\d{1,2}/\d{1,2}/\d{2}" placeholder="dd/mm/yy"></td>
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
                    <th>Location:</th>
                    <td>
                        <input type="radio" id="onSite" name="location" value="On site">
                        <label for="onSite">On site</label>
                        <input type="radio" id="remote" name="location" value="Remote">
                        <label for="remote">Remote</label>
                    </td>
                </tr>
                <tr>
                    <th>Accept Application by:</th>
                    <td>
                        <input type="checkbox" id="post" name="applicationType[]" value="Post">
                        <label for="post">Post</label>
                        <input type="checkbox" id="email" name="applicationType[]" value="Email">
                        <label for="email">Email</label>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>