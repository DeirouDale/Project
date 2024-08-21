<?php
include('../../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    $status = 2;
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    // Define the upload directory
    $upload_dir = "../../Submitted_Task_Files/";
    
    // Check if a file was uploaded
    if (!empty($file_name)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            // Update the task with the file
            $sql = "UPDATE employee_tasks SET submitted_file = '$file_name', returned = NULL, comments = '$comments', status = '$status', date_completed = NOW() WHERE id = '$task_id'";
        } else {
            echo "Failed to upload file.";
            exit();
        }
    } else {
        // If no file is uploaded, update the task without the file
        $sql = "UPDATE employee_tasks SET comments = '$comments', status = '$status', date_completed = NOW() WHERE id = '$task_id'";
    }

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: ../Tasks.php?submission=success");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
