<?php
session_start();
include("../connection.php");

// Retrieve the school_id from the session
$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : 'Not logged in';

// Optionally check if the user is logged in based on session
if ($school_id === 'Not logged in') {
    header("Location: login.php?error=Please log in first");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDO Batac LRMS</title>
	<?php include("../Users/constants/style.php"); ?>
</head>
<body>
    <!-- SIDEBAR -->
	<?php include("../Users/constants/side_bar.php"); ?>

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php include("../Users/constants/nav.php"); ?>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Dashboard -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title" id= "name2">
					<div class="left">
						<h1>Dashboard</h1>
				</div><hr>

				<ul class="box-info">
					<li>
						<i class='bx bxs-group' ></i>
					
						<span class="text">
							<h3></h3>
							<p>No. of Candidates</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-check-square' ></i>
						<span class="text">
							
						<span>
							<p>Total Voters</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-user-check' ></i>
						
						<span class="text">
							<h3>%</h3>
							<p>Turn out of Votes</p>
						</span>
					</li>
				</ul>
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>Turn out of Votes by Courses</h2><hr>
					</div>
				</div>
				<ul class="box-info-2"> 
					<li>
						<i><img src= "../Img/2.png" width= 80px height= 80px></i>
						
						<span class="text">
							<h3>%</h3>
							<p>BS in Agricultural and Biosystems Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/9.png" width= 80px height= 80px></i>
						
						<span class="text">
							<h3>%</h3>
							<p>BS in Ceramics Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/7.png" width= 80px height= 80px></i>
						
						<span class="text">
							<h3>%</h3>
							<p>BS in Chemical Engineering</p>
						</span>
					</li>
					
				</ul>
			</div>
		</main>
		<!-- Votes -->                      
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="../script.js"></script>
</body>
</html>