<?php

$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');

if(isset($_POST['submit'])){

      $firstname = $_POST['first_name'];
      $lastname = $_POST['last_name'];
      $student_number = $_POST['student_number'];
      $course = $_POST['course'];
      $year_level = $_POST['year_level'];
      
      //generate voters id
      $set = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxy~`!@#$%^&*()_';
      $generator = substr(str_shuffle($set), 0, 7);

     mysqli_query($conn, "INSERT INTO voters (first_name, last_name, student_number, course, year_level, password) VALUES ( '$firstname', '$lastname','$student_number', '$course','$year_level','$generator')") or die('query failed');
} 	
?>