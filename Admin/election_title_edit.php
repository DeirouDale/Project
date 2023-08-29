<?php include '../connection.php';?>
<?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the updated content and record ID from the form
$title = $_POST['title'];
$id = $_POST['id'];

// Update the database
$sql = mysqli_query($conn, "UPDATE election_title SET title = '$title' WHERE id = 1");

if($sql){
    header('location: Election-Title.php');
}

?>
