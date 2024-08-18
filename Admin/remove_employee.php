<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];

    $query = "DELETE FROM employees WHERE employee_id='$employee_id'";
    if (mysqli_query($conn, $query)) {
        echo "Employee removed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
