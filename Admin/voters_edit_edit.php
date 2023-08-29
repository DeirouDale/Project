<?php include '../connection.php';?>
<?php 

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

	<script src="../script.js"></script>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>