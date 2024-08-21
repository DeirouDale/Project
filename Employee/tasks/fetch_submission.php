<?php
// fetch_submission.php
include('../../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];

    $sql = "SELECT file_name, comments FROM employee_tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $submission = $result->fetch_assoc();
        echo json_encode($submission);
    } else {
        echo json_encode(['error' => 'No submission found']);
    }
}
?>
