<?php 
session_start(); // Ensure session is started
include("../../connection.php");

$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : null;

if (!$school_id) {
    die("School ID is not set in the session.");
}

$year = isset($_POST['year']) ? $_POST['year'] : '2024-2025';
$month = isset($_POST['month']) ? $_POST['month'] : date('m');
$day = isset($_POST['day']) ? $_POST['day'] : date('d');

// Get the school name
$stmt_school = $conn->prepare("SELECT school_name FROM schools WHERE school_id = ?");
$stmt_school->bind_param("s", $school_id);
$stmt_school->execute();
$school_result = $stmt_school->get_result();
$school_name = $school_result->num_rows > 0 ? $school_result->fetch_assoc()['school_name'] : 'Unknown_School';
$stmt_school->close();

// Ensure correct year format for querying
$full_year = preg_match('/^\d{4}-\d{4}$/', $year) ? $year : $year . '-' . (intval(substr($year, 0, 4)) + 1);

// Prepare and execute the query
$stmt = $conn->prepare("SELECT * FROM `1` WHERE year = ? AND month = ? AND day = ? AND school_id = ?");
$stmt->bind_param("ssss", $full_year, $month, $day, $school_id);
$stmt->execute();
$result = $stmt->get_result();
$date = DateTime::createFromFormat('!m', $month);
$month_name = $date ? $date->format('F') : 'Unknown';

// If no data exists, insert default rows
if ($result->num_rows === 0) {
    $default_values = [
        ['program_name' => 'Madrasah Education Program (MEP)', 'category' => 'Muslim'],
        ['program_name' => 'Madrasah Education Program (MEP)', 'category' => 'Non-Muslim'],
        ['program_name' => 'Special Science Elementary School (SSES)', 'category' => '']
    ];

    foreach ($default_values as $values) {
        $stmt_insert = $conn->prepare("INSERT INTO `1` 
            (school_id, year, month, day, program_name, category, kindergarten_male, kindergarten_female, grade1_male, grade1_female, grade2_male, grade2_female, grade3_male, grade3_female, grade4_male, grade4_female, grade5_male, grade5_female, grade6_male, grade6_female, total_male, total_female, submitter_name)
            VALUES 
            (?, ?, ?, ?, ?, ?, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ?)");
        $stmt_insert->bind_param("sssssss", $school_id, $full_year, $month, $day, $values['program_name'], $values['category'], $school_id); // Use school_id as submitter_name
        
        if (!$stmt_insert->execute()) {
            die("Error inserting data: " . $conn->error);
        }
    }

    // Refresh the result set after insertion
    $stmt->execute(); // Re-run the query to get the newly inserted data
    $result = $stmt->get_result();
}

// Initialize an array to store data
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();
?>
