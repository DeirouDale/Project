<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
    
    $query = "UPDATE employees SET
        name = '$name',
        position = '$position',
        department = '$department',
        email = '$email',
        contact_number = '$contact_number',
        status = '$status',
        usertype = '$usertype'
        WHERE employee_id = '$employee_id'";
    
    if (mysqli_query($conn, $query)) {
        echo "Employee updated successfully";
    } else {
        echo "Error updating employee: " . mysqli_error($conn);
    }
}
?>
