<?php
session_start();
include("../../connection.php");

// Check if the user is logged in
if (!isset($_SESSION['school_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the announcement ID from POST data
    $announcement_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($announcement_id > 0) {
        // Prepare the DELETE SQL statement
        $sql = "DELETE FROM announcements WHERE id = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the ID parameter
            $stmt->bind_param("i", $announcement_id);

            // Execute the statement
            if ($stmt->execute()) {
                // Success
                header("Location: ../Announcements.php?message=Announcement removed successfully");
            } else {
                // Error executing statement
                header("Location: ../Announcements.php?error=Error removing announcement: " . $conn->error);
            }

            // Close the statement
            $stmt->close();
        } else {
            // Error preparing statement
            header("Location: ../Announcements.php?error=Error preparing SQL statement: " . $conn->error);
        }
    } else {
        // Invalid ID
        header("Location: ../Announcements.php?error=Invalid announcement ID");
    }
} else {
    // Not a POST request
    header("Location: ../Announcements.php?error=Invalid request method");
}

// Close the database connection
$conn->close();
?>
