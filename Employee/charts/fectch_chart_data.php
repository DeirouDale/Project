<?php
include '../../connection.php';

if (isset($_POST['year'])) {
    $year = intval($_POST['year']);
    $chartNumber = intval($_POST['chartNumber']);

    // SQL to fetch completed tasks for the selected year
    $sql = "SELECT DATE_FORMAT(date_completed, '%Y-%m') AS month, COUNT(*) AS task_count 
            FROM employee_tasks 
            WHERE status = 2 AND YEAR(date_completed) = $year
            GROUP BY month 
            ORDER BY month";

    $result = $conn->query($sql);

    $months = [];
    $taskCounts = [];

    while ($row = $result->fetch_assoc()) {
        $months[] = date('F Y', strtotime($row['month'] . '-01'));
        $taskCounts[] = $row['task_count'];
    }

    echo json_encode(['months' => $months, 'taskCounts' => $taskCounts]);
}
?>
