<?php
include('../../connection.php');

header('Content-Type: application/json');

$date = $_POST['date'] ?? '';

if ($date) {
    $stmt = $pdo->prepare("
        SELECT * FROM learners_by_program WHERE date = :date
    ");
    $stmt->execute(['date' => $date]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No date provided']);
}
?>
