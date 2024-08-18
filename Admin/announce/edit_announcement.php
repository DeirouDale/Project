<?php
session_start();
include("../../connection.php");

// Check if the user is logged in
$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : null;
if (!$school_id) {
    header("Location: login.php?error=Please log in first");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_posted = $_POST['date_posted'];
    $status = $_POST['status'];
    
    // Handle file upload if necessary
    $file_name = '';
    if (!empty($_FILES['task_files']['name'][0])) {
        // Process file upload
        $file_name = $_FILES['task_files']['name'][0];
        $target_dir = "../../Announcements/";
        $target_file = $target_dir . basename($file_name);
        move_uploaded_file($_FILES['task_files']['tmp_name'][0], $target_file);
    }

    // Update the announcement in the database
    $sql = "UPDATE announcements SET title=?, description=?, date_posted=?, status=?, file_name=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi", $title, $description, $date_posted, $status, $file_name, $id);

    if ($stmt->execute()) {
        header("Location: ../Announcements.php?success=Announcement updated successfully");
    } else {
        die("Error updating record: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
