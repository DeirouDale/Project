<?php include '../connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>COE-Voting-System</title>
</head>
<body>
  	<?php
				$id = $_POST['bookId'];
				$sql = "SELECT * FROM voters WHERE id = $id";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);
					$row=mysqli_fetch_assoc($res);
			
                    $firstname = $row['first_name'];
     				$lastname = $row['last_name'];
      				$student_number = $row['student_number'];
     				$course = $row['course'];
      				$year_level = $row['year_level'];



    ?>
		<h2>Update Voter</h2>
		<div class= "form">
					<form method="POST" action="voters_edit_edit.php?id= <?php echo $id; ?>">
					<div class="form-elements">
						<label for= "first_name">First Name</label>
						<input type="text" id= "first_name" name= "first_name" value= "<?Php echo $firstname ?>">
					<div class="form-elements">
						<label for= "last_name">Last Name</label>
						<input type="text" id= "last_name" name= "last_name"  value= "<?Php echo $lastname ?>"required>
					</div>
					<div class="form-elements">
						<label for= "student_number">Student Number</label>
						<input type="text" id= "student_number" name= "student_number" value= "<?Php echo $student_number ?>"  required>
					</div>
					<div class="form-elements">
						<label for= "course">Course</label>
						<select class="form-elements" id="course" name="course">
						<option value="" selected>"<?Php echo $course ?>" </option>
						<option>BS in Agricultural and Biosystems Engineering</option>
						<option>BS in Ceramics Engineering</option>
						<option>BS in Chemical Engineering</option>
						<option>BS in Civil Engineering</option>
						<option>BS in Computer Engineering</option>
						<option>BS in Electrical Engineering</option>
						<option>BS in Electronics Engineering</option>
						<option>BS in Mechanical Engineering</option>

						</select>
					</div>
					<div class="form-elements">
						<label for= "year_level">Year Level</label>
						<input type="number" id= "year_level" min = "1"  max = "5" name= "year_level" value= "<?Php echo $year_level ?>" required>
					</div>
					<div class="form-elements">
						<button type = "Submit" class= "submit" name="edit_voters" onclick="return confirm('Are you sure you want to update this vote?')">Submit</label>
					</form>
					</div>

				</div> 
		</div>

		<?php
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

</body>
</html>