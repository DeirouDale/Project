<?php
session_start();
include("../../connection.php");

// Function to generate a 15-digit number
function generateFileId() {
    return str_pad(mt_rand(1, 999999999999999), 15, '0', STR_PAD_LEFT);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $description = $_POST['description'];
    $employee_name = $_POST['employee_name'];
    $date_assigned = $_POST['date_assigned'];
    $deadline = $_POST['deadline'];
    $status = '1';

    // Initialize file-related variables
    $filePath = null;
    $fileName = null;

    // Generate a 15-digit file_id
    $file_id = generateFileId();

    // Check if files are uploaded
    if (isset($_FILES['task_files']) && $_FILES['task_files']['error'][0] === UPLOAD_ERR_OK) {
        // Handle file upload
        $tmp_name = $_FILES['task_files']['tmp_name'][0];
        $fileName = $_FILES['task_files']['name'][0];
        $filePath = "../../Task_Files/" . basename($fileName);
        
        // Move uploaded file to the desired directory
        if (move_uploaded_file($tmp_name, $filePath)) {
            // File uploaded successfully
        } else {
            // Handle error
            die("Error uploading file.");
        }
    }

    // Prepare the SQL statement
    if ($filePath !== null) {
        // File is present
        $stmt = $conn->prepare("INSERT INTO employee_tasks (file_id, description, employee_name, file_name, date_assigned, deadline, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issssss', $file_id, $description, $employee_name, $fileName, $date_assigned, $deadline, $status);
    } else {
        // No file is present
        $fileName = ''; // Set file_name to an empty string if no file is uploaded
        $stmt = $conn->prepare("INSERT INTO employee_tasks (file_id, description, employee_name, file_name, date_assigned, deadline, status) VALUES (?, ?, ?, '', ?, ?, ?)");
        $stmt->bind_param('issssi', $file_id, $description, $employee_name, $date_assigned, $deadline, $status);
    }

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Redirect to the main page or show a success message
    header("Location: ../Tasks.php"); // Adjust the redirection as needed
    exit();
}
?>
