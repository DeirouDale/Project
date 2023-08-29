<?php

	$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');

	if(isset($_POST['add'])){
		$positions = $_POST['positions'];
		$number_of_candidates = $_POST['number_of_candidates'];
		$restriction = $_POST['restriction'];

		
		 mysqli_query($conn, "INSERT INTO position (position, number_of_candidates, restriction) VALUES ('$positions', '$number_of_candidates', '$restriction')") or die('query failed');
		}
?>