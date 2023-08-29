<?php include '../connection.php';?>
<?php
// Retrieve the search value, selected course, and selected voted status from the URL parameters
$searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : ''; // Set default value to an empty string if not provided
$selectedCourse = $_GET['course'];
$selectedVoted = $_GET['voted'];

// Generate the SQL query based on the search and filter criteria
$sql = "SELECT * FROM voters";

if (!empty($searchValue)) {
    $sql .= " WHERE (student_number LIKE '%$searchValue%' OR first_name LIKE '%$searchValue%' OR last_name LIKE '%$searchValue%')";
}

if ($selectedCourse !== 'All Courses') {
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND course = '$selectedCourse'";
    } else {
        $sql .= " WHERE course = '$selectedCourse'";
    }
}

if ($selectedVoted !== 'All') {
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND voted = '$selectedVoted'";
    } else {
        $sql .= " WHERE voted = '$selectedVoted'";
    }
}

// Execute the SQL query and fetch the results
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);

// If no filter is selected or no search term is provided, retrieve all records
if (empty($searchValue) && $selectedCourse === 'All Courses' && $selectedVoted === 'All') {
    $sql = "SELECT * FROM voters";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Table</title>
    <style>
        /* Define your CSS styles for the printable table */
        /* For example: */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Printable Table</h1>

    <table>
        <thead>
            <tr>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>Password</th>
                <th>Voted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $studentNumber = $row['student_number'];
                    $firstName = $row['first_name'];
                    $lastName = $row['last_name'];
                    $course = $row['course'];
                    $yearLevel = $row['year_level'];
                    $password = $row['password'];
                    $voted = $row['voted'];

                    echo "<tr>";
                    echo "<td>$studentNumber</td>";
                    echo "<td>$firstName</td>";
                    echo "<td>$lastName</td>";
                    echo "<td>$course</td>";
                    echo "<td>$yearLevel</td>";
                    echo "<td>$password</td>";
                    echo "<td>$voted</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        // Automatically trigger the print dialog when the page is loaded
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
