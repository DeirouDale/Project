<?php
include("../connection.php"); // Adjust path as necessary

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        // Redirect with error message if passwords do not match
        header("Location: your_registration_page.php?error=Passwords do not match");
        exit();
    }
    
    // Hash the password with MD5
    $hashed_password = md5($password);

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (school_id, password, type) VALUES (?, ?, ?)");
    // Assuming 'type' field value is 0 (you can adjust this as needed)
    $type = 0; 

    // Bind parameters
    $stmt->bind_param("ssi", $school_id, $hashed_password, $type);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to login page or display success message
        header("Location: login.php?success=Registration successful. Please log in.");
    } else {
        // Redirect with error message if the query fails
        header("Location: login.php?error=Registration failed. Please try again.");
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
