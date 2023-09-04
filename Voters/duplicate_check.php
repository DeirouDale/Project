<?php

session_start();

include("../connection.php");
include("../User/functions.php");

$user_data = check_login($conn);

$student_number = $_SESSION['student_number'];

$col_student_number = preg_replace('/-/', '', $student_number);
$check = mysqli_query($conn, "SELECT student_number FROM `votes` WHERE student_number = '$col_student_number'");
$check_voter = mysqli_num_rows($check) > 0; 


$check_state = mysqli_query($conn, "SELECT * FROM `election_state`"); 
$fetch_state = mysqli_fetch_assoc($check_state);


if(!$check_voter && $fetch_state['state'] == 'open'){
    header("location:index.php");
}
else if(!$check_voter && $fetch_state['state'] == 'close'){
    header("location:close_election.php");
}
else{
    header("location:duplicate.php");
}

?>