<!DOCTYPE html>
<html lang="en">
<head>
	<title>COE-Voting-System</title>
</head>
<body>
<div id="popup1" class="overlay">
<div class="popup">
  	<a class="close" href="Voters.php">&times;</a>


  	<?php
				$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');
				$sql = "SELECT * FROM voters ";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);
					$row=mysqli_fetch_assoc($res);
			
                    $firstname = $row['first_name'];
     				$lastname = $row['last_name'];
      				$student_number = $row['student_number'];
     				$course = $row['course'];
      				$year_level = $row['year_level'];



                    ?>
		<h1>Update Voter</h1>
		<div class= "form">
					<form method="POST">
					<div class="form-elements">
						<label for= "first_name">First Name</label>
						<input type="text" id= "first_name" name= "first_name" placeholder="New First Name" required>
					</div>
					<div class="form-elements">
						<label for= "last_name">Last Name</label>
						<input type="text" id= "last_name" name= "last_name"  required>
					</div>
					<div class="form-elements">
						<label for= "student_number">Student Number</label>
						<input type="text" id= "student_number" name= "student_number"  required>
					</div>
					<div class="form-elements">
						<label for= "course">Course</label>
						<input type="text" id= "course" name= "course"  value= required>
					</div>
					<div class="form-elements">
						<label for= "year_level">Year Level</label>
						<input type="number" id= "year_level" min = "1"  max = "5" name= "year_level"required>
					</div>
					<div class="form-elements">
						<button class= "submit" name="edit_voters" >Submit</label>
					</form>
					</div>

				</div> 
		</div>
		<?php
				$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');
				$sql = "SELECT * FROM voters";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);

               if ($count>0) {
                    	while ($row=mysqli_fetch_assoc($res)) 
					{
						$firstname = $row['first_name'];
     					$lastname = $row['last_name'];
      					$student_number = $row['student_number'];
     					$course = $row['course'];
      					$year_level = $row['year_level'];
					
   ?> 
				
		<?php
	}
}
?>
<?php 
	$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');

	if (isset($_POST['edit_voters'])) 
	{
	 	$id = $_GET['id'];
		$firstname = $_POST['first_name'];
     	$lastname = $_POST['last_name'];
      	$student_number = $_POST['student_number'];
     	$course = $_POST['course'];
      	$year_level = $_POST['year_level'];
		$sql = "UPDATE voters SET first_name = '$firstname', last_name = '$lastname', student_number = '$student_number', course = '$course', year_level = '$year_level' WHERE id = '$id'";
		$res = mysqli_query($conn,$sql);


	header('location: Voters.php');
}

?>

	<script src="script.js"></script>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
</body>
</html>