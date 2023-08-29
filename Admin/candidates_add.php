<?php include '../connection.php';?>
<?php
	

	if(isset($_POST['add'])){
		$position = $_POST['Position'];
		$firstname = $_POST['Fname'];
		$lastname = $_POST['Lname'];	
		$student_number = $_POST['SNum'];
		$course = $_POST['Course'];
		$platform = $_POST['platform'];
		$image_name = $_FILES["image"]['name'];
		if(!empty($image_name)){
			move_uploaded_file($_FILES["image"]['tmp_name'], '../Candidate/'.$image_name);	
		}

		 mysqli_query($conn, "INSERT INTO candidates (profile, student_number, first_name, last_name, course, position_id,platform) VALUES ('$image_name', '$student_number', '$firstname', '$lastname', '$course', '$position','$platform')")or die('query failed');

		$code = mysqli_insert_id($conn);

		$select_candidate = mysqli_query($conn, "SELECT * FROM `candidates` WHERE id = $code");

		$fetch_candidate = mysqli_fetch_assoc($select_candidate);

		$cid = $fetch_candidate['id'];
		$fname = $fetch_candidate['first_name'];
		$lname = $fetch_candidate['last_name'];
		$cname = $fname . " " . $lname;

		$pid = $fetch_candidate['position_id'];
		$select_position = mysqli_query($conn, "SELECT * FROM `position` WHERE id = $pid");
		$fetch_position = mysqli_fetch_assoc($select_position);

		$cposition = $fetch_position['position'];

		$insert = mysqli_query($conn, "INSERT INTO result (id, position, name) VALUES('$cid', '$cposition', '$cname')")or die('query failed');

		$sql = "DELETE FROM votes";
		$res = mysqli_query($conn,$sql);
		$update_state = mysqli_query($conn, "UPDATE `voters` SET voted='No'");
	}
?>