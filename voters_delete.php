<?php

$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');

		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			$sql = "DELETE FROM voters WHERE id=$id";
			$res = mysqli_query($conn,$sql);
			header('location: voters.php');
			}


			
 ?>