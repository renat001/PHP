<?php
// Database connection settings
$host = "localhost";
$username = "username";
$password = "password";
$dbname = "users";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all jobs, order by newest first
$sql = "SELECT id, title, company, location, posted_at FROM jobs ORDER BY posted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Job Board - Listings</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: auto; padding: 20px; }
        h1 { text-align: center; }
        .job { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .job-title { font-size: 1.2em; margin-bottom: 5px; }
        .company { color: #555; }
        .location { color: #888; }
        .posted-date { font-size: 0.9em; color: #aaa; }
        a { text-decoration: none; color: #0066cc; }
        a:hover { text-decoration: underline; }
        .no-jobs { text-align: center; color: #666; margin-top: 50px; }
        .submit-link { margin-bottom: 20px; display: block; text-align: center; }
    </style>
</head>
<body>
    <h1>Job Board</h1>

    <a href="submit.php" class="submit-link">Post a Job</a>

    <?php
    if ($result && $result->num_rows > 0) {
        while ($job = $result->fetch_assoc()) {
            $jobId = htmlspecialchars($job['id']);
            $title = htmlspecialchars($job['title']);
            $company = htmlspecialchars($job['company']);
            $location = htmlspecialchars($job['location']);
            $postedAt = date("F j, Y", strtotime($job['posted_at']));
            echo "
            <div class='job'>
                <div class='job-title'><a href='job.php?id=$jobId'>$title</a></div>
                <div class='company'>$company</div>
                <div class='location'>$location</div>
                <div class='posted-date'>Posted on $postedAt</div>
            </div>
            ";
        }
    } else {
        echo "<div class='no-jobs'>No job listings found.</div>";
    }

    $conn->close();
    ?>

</body>
</html>