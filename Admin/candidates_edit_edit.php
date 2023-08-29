<?php include '../connection.php';?>
<?php 

	if (isset($_POST['edit_cad'])) 
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
			$sql = "UPDATE candidates SET position_id ='$position' ,profile = '$filename',first_name = '$firstname', last_name = '$lastname', student_number = '$student_number', course = '$course', platform = '$platform' WHERE id = '$id'";
			$res = mysqli_query($conn,$sql);
		} else{
			$sql = "UPDATE candidates SET position_id ='$position',first_name = '$firstname', last_name = '$lastname', student_number = '$student_number', course = '$course', platform = '$platform' WHERE id = '$id'";
			$res = mysqli_query($conn,$sql);
		}


		$select_candidate = mysqli_query($conn, "SELECT * FROM `candidates` WHERE id = $id");

		$fetch_candidate = mysqli_fetch_assoc($select_candidate);

		$fname = $fetch_candidate['first_name'];
		$lname = $fetch_candidate['last_name'];
		$cname = $fname . " " . $lname;

		$pid = $fetch_candidate['position_id'];
		$select_position = mysqli_query($conn, "SELECT * FROM `position` WHERE id = $pid");
		$fetch_position = mysqli_fetch_assoc($select_position);

		$cposition = $fetch_position['position'];

		$insert = mysqli_query($conn, "UPDATE result set position='$cposition', name='$cname' WHERE id='$id'")or die('query failed');

		if($insert){

			header("location:Candidates.php");
		}
		$sql = "DELETE FROM votes";
			$res = mysqli_query($conn,$sql);
			$update_state = mysqli_query($conn, "UPDATE `voters` SET voted='No'");
}

?>