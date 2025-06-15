<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Search Results</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $title = isset($_GET['title']) ? $_GET['title'] : '';
            $position = isset($_GET['position']) ? $_GET['position'] : '';
            $contract = isset($_GET['contract']) ? $_GET['contract'] : '';
            $applicationType = isset($_GET['applicationType']) ? $_GET['applicationType'] : '';
            $location = isset($_GET['location']) ? $_GET['location'] : '';

            $filePath = '/home/students/accounts/s104071453/cos30020/www/data/jobs/positions.txt';

            if (!file_exists($filePath) || !is_readable($filePath)) {
                die("Error: The job vacancy file cannot be found or read.<br><a href='searchjobform.php'>Return to Search Job Vacancy</a>");
            }

            $handle = fopen($filePath, 'r');
            if (!$handle) {
                die("Error: Unable to open file for reading.<br><a href='searchjobform.php'>Return to Search Job Vacancy</a>");
            }

            $matches = []; // Array to store matching job vacancies
        
            while (!feof($handle)) {
                $line = fgets($handle);
                if ($line) {
                    $data = explode("\t", trim($line)); // Trim any excess whitespace or tabs
        
                    // Apply filters to match user input with job data
                    if ($title && stripos($data[1], $title) === false)
                        continue;
                    if ($position && $position != $data[4])
                        continue;
                    if ($contract && $contract != $data[5])
                        continue;
                    if ($location && $location != $data[6])
                        continue;

                    // Filter by application type only if it was set
                    if ($applicationType) {
                        // Check both possible application type fields
                        $foundType = false;
                        if (stripos($data[7], $applicationType) !== false)
                            $foundType = true;
                        if (isset($data[8]) && stripos($data[8], $applicationType) !== false)
                            $foundType = true;
                        if (!$foundType)
                            continue;
                    }

                    // Construct the application types string
                    $applicationTypeString = '';
                    if (!empty($data[7])) {
                        $applicationTypeString = $data[7];
                    }
                    if (!empty($data[8])) {
                        if (!empty($applicationTypeString)) {
                            $applicationTypeString .= ', ';
                        }
                        $applicationTypeString .= $data[8];
                    }

                    // Store the matched entry in the array
                    $matches[] = [
                        $data[0],  // Position ID
                        $data[1],  // Title
                        $data[2],  // Description
                        $data[3],  // Closing Date
                        $data[4],  // Position
                        $data[5],  // Contract
                        $data[6],  // Location
                        $applicationTypeString  // Application Types
                    ];
                }
            }
            fclose($handle);

            // Sort the matching results by closing date (most recent first)
            usort($matches, function ($a, $b) {
                $dateA = DateTime::createFromFormat('d/m/y', trim($a[3]));
                $dateB = DateTime::createFromFormat('d/m/y', trim($b[3]));

                if ($dateA == $dateB) {
                    return 0;
                }
                return ($dateA > $dateB) ? -1 : 1;
            });

            // Display the search results
            if (empty($matches)) {
                // If no matches were found, display a message
                echo "No matching job vacancies found.<br>";
            } else {
                // Display the results
                echo "<table>";
                echo "<tr><th>Position ID</th><th>Title</th><th>Description</th><th>Closing Date</th><th>Position</th><th>Contract</th><th>Location</th><th>Application Types</th></tr>";
                foreach ($matches as $match) {
                    echo "<tr>";
                    foreach ($match as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>
        <br>
        <a href="index.php">Return to Home</a>
        <br>
        <a href="searchjobform.php">Continue Searching</a>
    </div>
</body>

</html>