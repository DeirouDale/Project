<?php

session_start();

if(isset($_SESSION['student_number'])){
    unset($_SESSION['student_number']);
}
header("location:Log_in.php");
die;

?>