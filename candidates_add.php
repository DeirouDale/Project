<?php
	
	$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');

	if(isset($_POST['add'])){
		$position = $_POST['Position'];
		$firstname = $_POST['Fname'];
		$lastname = $_POST['Lname'];	
		$student_number = $_POST['SNum'];
		$course = $_POST['Course'];
		$platform = $_POST['platform'];
		$image_name = $_FILES["image"]['name'];
		if(!empty($image_name)){
			move_uploaded_file($_FILES["image"]['tmp_name'], '../Project/Candidate/'.$image_name);	
		}

		 mysqli_query($conn, "INSERT INTO candidates (profile, student_number, first_name, last_name, course, position_id,platform) VALUES ('$image_name', '$student_number', '$firstname', '$lastname', '$course', '$position','$platform')")or die('query failed');
	}
?>