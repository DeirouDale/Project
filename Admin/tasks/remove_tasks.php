<?php
include("../../connection.php");

// Check if the task ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $task_id = intval($_GET['id']);

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM employee_tasks WHERE id = ?");
    $stmt->bind_param("i", $task_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the tasks page with a success message
        header("Location: ../Tasks.php?message=Task+deleted+successfully");
        exit();
    } else {
        // Redirect back with an error message
        header("Location: ../Tasks.php?message=Error+deleting+task");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect back with an error message if ID is not provided
    header("Location: ../Tasks.php?message=No+task+ID+provided");
    exit();
}

// Close the database connection
$conn->close();
?>
