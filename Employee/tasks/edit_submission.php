<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 // edit_submission.php
    include('../../connection.php');

    $task_id = $_POST['task_id'];
    $comments = $_POST['comments'];
    $new_file_name = $_FILES['file']['name'];

    // Handle file upload if a new file is provided
    if (!empty($new_file_name)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($new_file_name);
        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

        // Update task with new file and comments
        $sql = "UPDATE employee_tasks SET submitted_file = ?, returned = NULL ,comments = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_file_name, $comments, $task_id);
    } else {
        // Update only comments if no new file is uploaded
        $sql = "UPDATE employee_tasks SET comments = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $comments, $task_id);
    }

    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect back to the tasks page or display a success message
    header("Location: ../Tasks.php");
    exit();
}
?>