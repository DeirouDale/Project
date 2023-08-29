<?php
include ('../connection.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>COE-Voting System</title>
	<link rel="stylesheet" href="style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
	<section class= "Navigation">
		<div class="header">
			<nav>
				<img class= "logo-img" src = "../Img/COE.png" width=60px height=60px>
			</nav>
		</div>
		<div class="main">	
			<h2>Summary</h2><hr>
			<?php
				session_start();

				$student_number = $_SESSION['student_number'];

				$res = mysqli_query($conn, "SELECT * FROM votes WHERE student_number = '$student_number'");
				if (mysqli_num_rows($res) > 0) {
					$row = mysqli_fetch_assoc($res);
					$select_candidate = mysqli_query($conn, "SELECT * FROM `candidates` WHERE id = ".$row['President']);
					print_r($select_candidate);
					while($row1 = mysqli_fetch_assoc($select_candidate));
						echo $row1['first_name'];
				}
			?>
		</div>
	</section>
</body>