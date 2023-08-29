<?php include '../connection.php';?>
<?php

		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			$sql = "DELETE FROM candidates WHERE id=$id";
			$res = mysqli_query($conn,$sql);
			$sql = "DELETE FROM votes";
			$res = mysqli_query($conn,$sql);
			mysqli_query($conn, "DELETE FROM result WHERE id=$id");
			$update_state = mysqli_query($conn, "UPDATE `voters` SET voted='No'");
			header('location: Candidates.php');
			}


			
 ?>