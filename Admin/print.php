<?php include '../connection.php';?>    
<?php
// print.php


// Retrieve the filtered course from the URL parameter
$courseFilter = isset($_GET['course']) ? $_GET['course'] : 'all';

// Prepare the query
if ($courseFilter === 'all') {
    $query = "SELECT * FROM voters";
} else {
    $query = "SELECT * FROM voters WHERE course = '$courseFilter'";
}

// Execute the query
$result = mysqli_query($conn, $query);

// Generate the HTML for printing
echo "<html>";
echo "<head><title>$courseFilter</title></head>";
echo "<style>
        body {
            font-family: Arial, sans-serif;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        
        table th {
            background-color: #f2f2f2;
        }
    </style>";
echo "<body>";
echo "<h1>$courseFilter</h1>";
echo "<table>";
echo "<thead><tr><th>Student Number</th><th>First Name</th><th>Last Name</th><th>Course</th><th>Year Level</th><th>Password</th></tr></thead>";
echo "<tbody>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
   echo "<td>{$row['student_number']}</td>";
    echo "<td>{$row['first_name']}</td>";
    echo "<td>{$row['last_name']}</td>";
    echo "<td>{$row['course']}</td>";
    echo "<td>{$row['year_level']}</td>";
    echo "<td>{$row['password']}</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</body>";
echo "</html>";

// Close the database connection
mysqli_close($conn);
?>