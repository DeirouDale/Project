<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $status = 'not yet approved'; // Default status

    $query = "INSERT INTO employees (employee_id, name, position, department, email, contact_number, status) 
              VALUES ('$employee_id', '$name', '$position', '$department', '$email', '$contact_number', '$status')";
    if (mysqli_query($conn, $query)) {
        echo "Employee added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
