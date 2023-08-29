<?php
include("../connection.php");

$select_position = mysqli_query($conn, "SELECT * FROM `position`");
if(mysqli_num_rows($select_position) > 0){
	while($fetch_position = mysqli_fetch_assoc($select_position)){

		$pid = $fetch_position['id'];
		$columnName = $fetch_position['columnName'];

		$select_candidate = mysqli_query($conn, "SELECT * FROM `candidates` WHERE position_id = '$pid'");
		if(mysqli_num_rows($select_candidate)>0){
			while($fetch_candidate = mysqli_fetch_assoc($select_candidate)){ 

				$cid = $fetch_candidate['id'];
				
				$select_vote = mysqli_query($conn, "SELECT * FROM `votes` WHERE $columnName = $cid");
				$count = mysqli_num_rows($select_vote);

				$update = mysqli_query($conn, "UPDATE `result` SET t_votes='$count' WHERE id = '$cid'");

			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

	<link rel="stylesheet" href="../style3.css">

	<title>COE-Voting-System</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs'> <img class= "logo-img" src = "../Img/COE.png" width=60px height=60px></i>
			<span class="text">Voting System</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="index.php" class="menu-link">
					<i class='bx bxs-home' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="Votes.php" class="menu-link">
					<i class='bx bxs-check-square' ></i>
					<span class="text">Votes</span>
				</a>
			</li>
			<li>
				<a href="Candidates.php" class="menu-link">
					<i class='bx bxs-user-check' ></i>
					<span class="text">Candidates</span>
				</a>
			</li>
			<li>
				<a href="Voters.php" class="menu-link">
					<i class='bx bxs-user-pin' ></i>
					<span class="text">Voter's</span>
				</a>
			</li>
			<li>
				<a href="Position.php" class="menu-link">
					<i class='bx bxs-certification'></i>
					<span class="text">Office</span>
				</a>
			</li>
			<li>
				<a href="Election-Title.php" class="menu-link">
					<i class='bx bxs-group' ></i>
					<span class="text">Election Title</span>
				</a>
			</li>
			<li>
				<a href="about_Us.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">About Us</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">

		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<form action="#">
				<div class="form-input">
					<input type="hidden" placeholder="Search here">
				</div>
			</form>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Dashboard -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>Votes</h1><hr>
						<br>
						<a class = "btn_addCandidates" href = "printresults.php"target="_blank">PRINT PREVIEW</a>
					</div>
				</div>
			</div>
			<div>
				<div class="top">
					<span class= "header">RESULTS</span>
				</div>
				<div class="result-container">
				<?php
					$select_position= mysqli_query($conn, "SELECT * FROM `position`");
					if(mysqli_num_rows($select_position) > 0){
						while($fetch_position = mysqli_fetch_assoc($select_position)){
							$id = $fetch_position['id'];
							$position = $fetch_position['position'];
							?>
							<div class="result-position">
								<span> <?php echo $position; ?> </span>
							</div>
							<div class="result-candidate-container">
							<?php 
							$result = mysqli_query($conn, "SELECT * FROM `result` WHERE position='$position'");
							if(mysqli_num_rows($result) > 0){
								while($fetch_result = mysqli_fetch_assoc($result)){
									$id = $fetch_result['id'];
									$name = $fetch_result['name'];
									$t_votes = $fetch_result['t_votes'];
									$voters_select = mysqli_query($conn, "SELECT * FROM `voters`");
									$voters_quantity = mysqli_num_rows($voters_select);

									$t_percent = (intval($t_votes)/intval($voters_quantity)) * 100 ;
									$img = mysqli_query($conn, "SELECT profile FROM `candidates` where id='$id' ");
									$fetch_img = mysqli_fetch_assoc($img);
									$img = $fetch_img['profile'];
									?>
									
										<div class="result-candidate">
											<div class="result-img">
												<img class="candidate_img" src="../Candidate/<?php echo $img; ?>" width=200px height=200px >
											</div>
											<div class="result-info">
												<span class="result-name"><?php echo $name; ?></span>
												<span class="result-percent"><?php echo round($t_percent, 2); ?>%</span>
											</div>
										</div>
									
								<?php
								}
							}
							
							?>
							</div>
						<?php	
						}
					}
				?>
				</div>
			</div>
			
				
				
			
			
		</main>
	</section>

	<script src="../script.js"></script>
</body>
</html>