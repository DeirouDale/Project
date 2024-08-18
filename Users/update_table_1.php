<?php
// connection.php should be included here to use $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $value = $_POST['value'];

    $sql = "UPDATE t1 SET $name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $value, $id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Update successful";
    } else {
        echo "No changes made";
    }

    $stmt->close();
}
?>
