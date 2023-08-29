<?php include '../connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>COE-Voting-System</title>
</head>
<body>
	
	<?php
		
		$id = $_POST['bookId'];

		$sql = "SELECT * FROM candidates WHERE id = " . $id;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
	?> 
	<div class="form">

		<form method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to edit this candidate?')"action="candidates_edit_edit.php?id=<?php echo $id; ?>">
			<h2>Edit Candidates</h2>
			<div class="form-elements">
				<label for="Fname">First Name</label>
				<input type="text" id="Fname" name="Fname" value="<?Php echo $row['first_name'] ?>" required>
			</div>
			<div class="form-elements">
				<label for="Lname">Last Name</label>
				<input type="text" id="Lname" name="Lname" value="<?Php echo $row['last_name'] ?>" required>
			</div>
			<div class="form-elements">
				<label for="SNum">Student Number</label>
				<input type="text" id="SNum" name="SNum" value="<?Php echo $row['student_number'] ?>" required>
			</div>
			<div class="form-elements">
				<label for="Course">Course</label>
				<select class="form-elements" id="Course" name="Course">
						<option value="" selected><?Php echo $row['course'] ?> </option>
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
    			<label for="Position">Positions</label>
    			<select class="form-elements" id="Position" name="Position">
        	<?php
            	$con = mysqli_connect('localhost', 'root', '', 'voting_system') or die('connection failed');
            	$sql1 = mysqli_query($con, "SELECT * FROM position");
            	while ($row1 = mysqli_fetch_array($sql1)) {
                	$selected = ($row1['id'] == $row['position_id']) ? 'selected' : '';
                	echo "<option value='". $row1['id'] ."' $selected>" .$row1['position'] ."</option>" ;
            	}
        		?>
    			</select>
			</div>

			<div class="form-elements">
				<label for="photo">New Photo</label>
				<input type="file" id="photo" name="newimage">
			</div>
			<div class="form-elements">
				<label for="platform">Platform</label>
				<textarea class="form-control" id="platform" name="platform" rows="5" cols="60"><?Php echo $row['platform'] ?></textarea>
			</div>
			<div class="form-elements">
				<button type="submit" class="Submit" name="edit_cad">Submit</button>
			</div>
		</form>
	</div>

	<script src="../script.js"></script>
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</body>
</html>
