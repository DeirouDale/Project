<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $status = '0'; // Default status
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']); // Capture the usertype

    $query = "INSERT INTO employees (employee_id, name, position, department, email, contact_number, status, usertype) 
              VALUES ('$employee_id', '$name', '$position', '$department', '$email', '$contact_number', '$status', '$usertype')";

    if (mysqli_query($conn, $query)) {
        echo "Employee added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
