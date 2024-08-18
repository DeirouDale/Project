<?php
// update_table.php

// Include database connection
include '../../connection.php';

// Function to generate a 10-digit tracking number
function generateTrackingNumber() {
    return sprintf('%010d', mt_rand(0, 9999999999));
}

// Function to get or generate tracking number based on day, month, year, and school_id
function getOrGenerateTrackingNumber($conn, $day, $month, $year, $schoolId) {
    // Check if a tracking number already exists for the given day, month, year, and school_id
    $sql = "SELECT DISTINCT `tracking_number` FROM `1` WHERE `day` = ? AND `month` = ? AND `year` = ? AND `school_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiii', $day, $month, $year, $schoolId);
    $stmt->execute();
    $stmt->bind_result($existingTrackingNumber);
    $stmt->fetch();
    $stmt->close();

    if ($existingTrackingNumber) {
        return $existingTrackingNumber; // Return existing tracking number
    } else {
        // Generate a new tracking number
        $newTrackingNumber = generateTrackingNumber();
        // Update all rows for the given day, month, year, and school_id with the new tracking number
        $sql = "UPDATE `1` SET `tracking_number` = ? WHERE `day` = ? AND `month` = ? AND `year` = ? AND `school_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('siiii', $newTrackingNumber, $day, $month, $year, $schoolId);
        $stmt->execute();
        $stmt->close();
        return $newTrackingNumber;
    }
}

// Get the JSON input from AJAX
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$name = $data['name'];
$value = $data['value'];
$day = $data['day'];
$month = $data['month'];
$year = $data['year'];
$schoolId = $data['school_id'];

// Use backticks to enclose the table name
$tableName = '1'; // Table name is a numeric literal

// Get or generate the tracking number
$trackingNumber = getOrGenerateTrackingNumber($conn, $day, $month, $year, $schoolId);

// Prepare the SQL query to update the specific row
$sql = "UPDATE `$tableName` SET `$name` = ?, `tracking_number` = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $value, $trackingNumber, $id);

if ($stmt->execute()) {
    // Success response with the tracking number
    echo json_encode(['status' => 'Success', 'tracking_num' => $trackingNumber]);
} else {
    // Error response
    echo json_encode(['status' => 'Error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
