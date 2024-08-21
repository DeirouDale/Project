<?php
session_start();
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_id = $_POST['school_id'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE school_id = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $school_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $_SESSION['school_id'] = $school_id;
        $_SESSION['user_type'] = $user_data['type']; // Store user type in session
        
        switch ($user_data['type']) {
            case 0:
                header("Location: Users/index.php");
                break;
            case 1:
                header("Location: SDO/index.php");
                break;
            case 2:
                header("Location: Admin/index.php");
                break;
            default:
                header("Location: login.php?error=Invalid User Type");
                break;
        }
    } else {
        header("Location: login.php?error=Invalid School ID or Password");
    }
    exit();
}
?>
