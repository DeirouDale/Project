<?php
session_start();
include('../connection.php'); // Ensure you have a database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register_btn'])) {
        $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']); // Sanitize the name input
        $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); // Encrypt password using MD5
        $confirm_password = md5(mysqli_real_escape_string($conn, $_POST['confirm_password'])); // Encrypt confirm password

        if ($password != $confirm_password) {
            header("Location: employee_login.php?error=Passwords do not match.");
            exit();
        }

        // Check if Employee ID already exists
        $check_query = "SELECT * FROM employees WHERE employee_id = '$school_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            header("Location: employee_login.php?error=Employee ID already exists.");
            exit();
        } else {
            // Insert the new employee with their name and encrypted password, setting status to 0
            $insert_query = "INSERT INTO employees (employee_id, name, password, status) VALUES ('$school_id', '$name', '$password', 0)";

            if (mysqli_query($conn, $insert_query)) {
                header("Location: employee_login.php?success=Registration successful! Please wait for account activation.");
                exit();
            } else {
                header("Location: employee_login.php?error=Registration failed. Please try again.");
                exit();
            }
        }
    }
}
?>
