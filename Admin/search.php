<?php include '../connection.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>Search and Display Content</title>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="search" placeholder="Enter your search term">
        <input type="submit" value="Search">
    </form>

    <?php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Step 2: Retrieve and sanitize the search term
        $searchTerm = $conn->real_escape_string($_POST['search']);

        // Step 3: Construct the SQL query
        $query = "SELECT * FROM voters WHERE first_name LIKE '%$searchTerm%' or last_name LIKE '%$searchTerm%' or student_number LIKE '%$searchTerm%'";

        // Step 4: Execute the query and fetch the results
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
            <th>Student Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Course</th>
            <th>Year Level</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['student_number'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['course'] . "</td>";
                echo "<td>" . $row['year_level'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No matching content found.</p>";
        }

        // Close the result set
        $result->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
