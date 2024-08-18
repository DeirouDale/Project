<?php
session_start();
include("../connection.php");

// Check if the user is logged in
if (!isset($_SESSION['school_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_posted = $_POST['date_posted'];
    $status = $_POST['status'];
    
    // Process uploaded files
    $file_names = [];
    if (isset($_FILES['task_files']) && $_FILES['task_files']['error'][0] == 0) {
        $files = $_FILES['task_files'];
        $upload_dir = "../../Announcements/"; // Define the directory to save uploaded files
        
        for ($i = 0; $i < count($files['name']); $i++) {
            $file_name = basename($files['name'][$i]);
            $upload_file = $upload_dir . $file_name;
            
            // Move uploaded file to the designated directory
            if (move_uploaded_file($files['tmp_name'][$i], $upload_file)) {
                $file_names[] = $file_name;
            } else {
                echo "Error uploading file: " . $file_name;
            }
        }
    }

    // Prepare file names for database
    $file_names_str = !empty($file_names) ? implode(",", $file_names) : '0';

    // Generate a 15-digit random number for file_id
    $file_id = str_pad(random_int(0, 999999999999999), 15, '0', STR_PAD_LEFT);
    
    // Insert announcement into the database
    $sql = "INSERT INTO announcements (title, description, date_posted, status, file_name, file_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $title, $description, $date_posted, $status, $file_names_str, $file_id);

    if ($stmt->execute()) {
        header("Location: ../Announcements.php?success=Announcement added successfully");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
