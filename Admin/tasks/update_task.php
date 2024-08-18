<?php
include("../../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = intval($_POST['id']);
    $employeeName = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $dateAssigned = mysqli_real_escape_string($conn, $_POST['date_assigned']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $status = intval($_POST['status']);
    
    // Handle file upload if necessary
    $fileNames = [];
    if (!empty($_FILES['task_files']['name'][0])) {
        foreach ($_FILES['task_files']['name'] as $key => $value) {
            $targetDir = "../../Task_Files/";
            $fileName = basename($_FILES['task_files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['task_files']['tmp_name'][$key], $targetFilePath)) {
                $fileNames[] = $fileName;
            }
        }
    }
    $fileNamesStr = implode(',', $fileNames);

    // Update the task in the database
    $updateQuery = "UPDATE employee_tasks SET 
                    employee_name='$employeeName', 
                    description='$description', 
                    date_assigned='$dateAssigned', 
                    deadline='$deadline', 
                    status=$status";
    
    if (!empty($fileNamesStr)) {
        $updateQuery .= ", file_name='$fileNamesStr'";
    }
    
    $updateQuery .= " WHERE id=$taskId";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: ../Tasks.php?msg=Task Updated Successfully");
        exit();
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
}

$conn->close();
?>
