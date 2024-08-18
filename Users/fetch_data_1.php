<?php
include("../connection.php");

// Query to fetch data
$sql = "SELECT * FROM `1`"; // Adjust the query if needed
$result = $connection->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($data);

$connection->close();
?>
