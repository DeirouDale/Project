<?php include '../connection.php';?>
<?php


if(isset($_POST['submit'])){

      $firstname = $_POST['first_name'];
      $lastname = $_POST['last_name'];
      $student_number = $_POST['student_number'];
      $course = $_POST['course'];
      $year_level = $_POST['year_level'];
      
      //generate voters id
      $set = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $generator = substr(str_shuffle($set), 0, 10);

     mysqli_query($conn, "INSERT INTO voters (first_name, last_name, student_number, course, year_level, password,voted) VALUES ( '$firstname', '$lastname','$student_number', '$course','$year_level','$generator', 'No')") or die('query failed');
} 	
?>