<?php
include("connection.php");

if (isset($_POST['employee_id'])) {
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
    
    $query = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(array("error" => "No data found"));
    }
}
?>
