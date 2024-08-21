<?php
include("../../connection.php");

if (isset($_GET['id'])) {
    $taskId = intval($_GET['id']);

    $updateQuery = "UPDATE employee_tasks 
                    SET status = 1, 
                        date_completed = NULL, returned= 1 
                    WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $taskId);

    if ($stmt->execute()) {
        header("Location: ../Tasks.php"); // Redirect back to your table page
    } else {
        echo "Error updating task: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
