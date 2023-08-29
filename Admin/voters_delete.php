<?php include '../connection.php';?>
<?php


		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			$sql = "DELETE FROM voters WHERE id=$id";
			$res = mysqli_query($conn,$sql);
			header('location: voters.php');
			}


			
 ?>