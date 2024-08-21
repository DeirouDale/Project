<?php
session_start();
include('../connection.php'); // Ensure you have a database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['log_in_btn'])) {
        // Handle Login
        $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); // Encrypt the entered password

        $query = "SELECT * FROM employees WHERE employee_id = '$school_id' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['status'] == 1) { // Check if the account is active
                $_SESSION['employee_name'] = $row['name']; // Store employee name in session
                $_SESSION['employee_id'] = $row['employee_id']; // Store employee ID in session
                $_SESSION['usertype'] = $row['usertype']; // Store usertype in session

                if ($row['usertype'] == 1) { // Check if the user is an admin
                    header("Location: ../Admin/index.php"); // Redirect admin to admin dashboard
                } else {
                    header("Location: ../Employee/index.php"); // Redirect regular users to the main dashboard
                }
                exit();
            } else {
                header("Location: employee_login.php?error=Your account is inactive. Please contact the administrator.");
                exit();
            }
        } else {
            header("Location: employee_login.php?error=Invalid Employee ID or Password.");
            exit();
        }
    }
}
?>
