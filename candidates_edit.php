<!DOCTYPE html>
<html lang="en">
<head>
	<title>COE-Voting-System</title>
</head>
<body>
<div id="popup1" class="overlay">
<div class="popup">
  	<a class="close" href="Candidates.php">&times;</a>
		<h1>Update Admin</h1>
		<?php
				$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');
				$sql = "SELECT *, candidates.id AS canid FROM candidates LEFT JOIN position ON position.id=candidates.position_id";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);
                    $row=mysqli_fetch_assoc($res);
					
					$id = $row['canid'];
                    $student_number = $row['student_number'];
                   	$lastname = $row['last_name'];
                    $firstname = $row['first_name'];
                    $position = $row['position'];
                    $course = $row['course'];
                    $platform = $row['platform'];
                      $image = (!empty($row['profile'])) ? '../Project/Candidate/'.$row['profile'] : '.../Project/Candidate/profile.jpg';
					
   ?> 
				<div class= "form">
					<form method="POST" enctype="multipart/form-data">
					<h2>Add Candidates</h2>
					<div class="form-elements">
						<label for= "FName">First Name</label>
						<input type="text" id= "Fname" name="Fname" required>
					</div>
					<div class="form-elements">
						<label for= "LName">Last Name</label>
						<input type="text" id= "Lname" name="Lname" required>
					</div>
					<div class="form-elements">
						<label for= "SNum">Student Number</label>
						<input type="text" id= "SNum" name="SNum" required>
					</div>
					<div class="form-elements">
						<label for= "Course">Course</label>
						<input type="text" id= "Course" name="Course" required>
					</div>
					<div class="form-elements">
						<label for= "Position">Positions</label>
						<select class="form-elements" id="Position" name="Position">
						<option value="" selected>- Select -</option>
						<?php
							$con = mysqli_connect('localhost','root','','voting_system') or die('connection failed');
							$sql = mysqli_query($con, "SELECT * From position");
							$row = mysqli_num_rows($sql);
							while ($row = mysqli_fetch_array($sql)){
							echo "<option value='". $row['id'] ."'>" .$row['position'] ."</option>" ;
							}
						?>
						</select>
					</div>
        			<label for="photo">New Photo</label>
					<input type="file" id="newimage" name="newimage">
					</div>
					<div class="form-elements">
						<label for= "platform">Platform</label>
					</div>
					<textarea class="form-control" id="platform" name="platform" rows="5" cols="60"></textarea>
					<div class="form-elements">
						<button class= "Submit" name="edit">Submit</label>
						</form>
					</div>
				</div>
		</div>

<?php 
	$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');
	$sql = "SELECT *, candidates.id AS canid FROM candidates LEFT JOIN position ON position.id=candidates.position_id";
	if (isset($_POST['edit'])) 
	{
	 	$id = $_GET['id'];
		$position = $_POST['Position'];
		$firstname = $_POST['Fname'];
		$lastname = $_POST['Lname'];	
		$student_number = $_POST['SNum'];
		$course = $_POST['Course'];
		$platform = $_POST['platform'];
		$filename = $_FILES['newimage']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['newimage']['tmp_name'], '../Candidate/'.$filename);	
		}
		$sql = "UPDATE candidates SET profile = '$filename',first_name = '$firstname', last_name = '$lastname', student_number = '$student_number', course = '$course', platform = '$platform' WHERE id = '$id'";
		$res = mysqli_query($conn,$sql);

		

	header('location: Candidates.php');
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
