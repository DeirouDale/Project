<?php

session_start();

if(isset($_SESSION['student_number'])){
    unset($_SESSION['student_number']);
}
header("location:index.php");
die;

?>