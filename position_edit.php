<!DOCTYPE html>
<html lang="en">
<head>
	<title>COE-Voting-System</title>
</head>
<body>
<div id="popup1" class="overlay">
<div class="popup">
  	<a class="close" href="Position.php">&times;</a>
		<h1>Update Admin</h1>
		<?php
				$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');
				$sql = "SELECT * FROM position";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);
                    $row=mysqli_fetch_assoc($res);
					
					$id = $row['id'];
					$positions = $row['position'];
					$number_of_candidates = $row['number_of_candidates'];
					$restriction = $row['restriction'];
					
   ?> 
				<div class= "form">
					<form method="POST">
					<h2>Edit Positions</h2>
					<div class="form-elements">
						<label for= "position">Positions</label>
						<input type="text" id= "positions" name="positions"  required>
					</div>
					<div class="form-elements">
						<label for= "LName">Number of Candidates</label>
						<input type="number" id= "number_of_candidates" name="number_of_candidates" min = "1" required >
					</div>
					<div class="form-elements">
						<label for= "restriction">Restriction</label>
						<input type="text" id= "restriction" name="restriction" required>
					</div>
					<div class="form-elements">
						<button class= "btn_addCandidates"name="edit">Edit</button>
						</form>
					</div>
				</div>
		</div>

<?php 
	$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');
	if (isset($_POST['edit'])) 
	{
	 	$id = $_GET['id'];
		$positions = $_POST['positions'];
		$number_of_candidates = $_POST['number_of_candidates'];
		$restriction = $_POST['restriction'];
		$sql = "UPDATE position SET position = '$positions', number_of_candidates = '$number_of_candidates', restriction = '$restriction' WHERE id = '$id'";
		$res = mysqli_query($conn,$sql);

		

	header('location: Position.php');
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