<?php
include("../connection.php");

if (isset($_POST['openbtn'])) {
		$change_state = mysqli_query($conn, "UPDATE election_state SET state = 'open', btn_class = 'closebtn', btn_name = 'closebtn'");
	}
if (isset($_POST['closebtn'])) {
	$change_state = mysqli_query($conn, "UPDATE election_state SET state = 'close', btn_class = 'openbtn', btn_name = 'openbtn'");
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
			<li class="active">
				<a href="index.php">
					<i class='bx bxs-home' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="Votes.php">
					<i class='bx bxs-check-square' ></i>
					<span class="text">Votes</span>
				</a>
			</li>
			<li>
				<a href="Candidates.php">
					<i class='bx bxs-user-check' ></i>
					<span class="text">Candidates</span>
				</a>
			</li>
			<li>
				<a href="Voters.php">
					<i class='bx bxs-user-pin' ></i>
					<span class="text">Voter's</span>
				</a>
			</li>
			<li>
				<a href="Position.php">
					<i class='bx bxs-certification'></i>
					<span class="text">Office</span>
				</a>
			</li>
			<li>
				<a href="Election-Title.php">
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
				<div class="head-title" id= "name2">
					<div class="left">
						<h1>Dashboard</h1>
					</div>
						<form method="POST">
							<?php
								$election_state_select = mysqli_query($conn, "SELECT * FROM `election_state`");
								$fetch_state = mysqli_fetch_assoc($election_state_select);
								$class = $fetch_state['btn_class'];
								$name = $fetch_state['btn_name'];
								$caption = "";
								if($fetch_state['state'] == 'open'){
									$caption = "CLOSE ELECTION";
								}
								else{
									$caption = "OPEN ELECTION";
								}
							?>
						<span> Election State: </span>
						<button class="<?php echo $class;?>" name="<?php echo $name;?>" onclick= "return confirm('Are you sure you want to change the election state?')"><?php echo $caption;?></button>
						</form>
					</div>
				</div><hr>

				<ul class="box-info">
					<li>
						<i class='bx bxs-group' ></i>
					<?php 

					$sql ="SELECT * FROM candidates";

					$res = mysqli_query($conn, $sql);

			        $count = mysqli_num_rows($res);
			        ?>
						<span class="text">
							<h3><?php echo $count; ?></h3>
							<p>No. of Candidates</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-check-square' ></i>
						<span class="text">
							<?php
							$sql = "SELECT * FROM `voters`";

							$res = mysqli_query($conn, $sql);

							$count = mysqli_num_rows($res);


							?>
							<h3><?php echo $count; ?></h3>
					<?php 

					$sql ="SELECT * FROM `votes`";

					$res = mysqli_query($conn, $sql);

					$count = mysqli_num_rows($res);
					
					?>
						<span>
							<p>Total Voters</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-user-check' ></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters`");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
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
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Agricultural and Biosystems Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Agricultural and Biosystems Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Agricultural and Biosystems Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/9.png" width= 80px height= 80px></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Ceramics Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Ceramics Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Ceramics Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/7.png" width= 80px height= 80px></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Chemical Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Chemical Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Chemical Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/8.png" width= 80px height= 80px></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Civil Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Civil Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Civil Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/6.png" width= 80px height= 80px></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Computer Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Computer Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Computer Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/1.png" width= 80px height= 80px></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Electrical Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Electrical Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Electrical Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/4.png" width= 80px height= 80px></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Electronics Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Electronics Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Electronics Engineering</p>
						</span>
					</li>
					<li>
						<i><img src= "../Img/3.png" width= 80px height= 80px></i>
						<?php 
									$t_votes = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Mechanical Engineering' AND voted = 'Yes'");
									$vote_quantity = mysqli_num_rows($t_votes);

									$voters_select = mysqli_query($conn, "SELECT * FROM `voters` where course = 'BS in Mechanical Engineering'");
									$voters_quantity = mysqli_num_rows($voters_select);

									if ($voters_quantity != 0) {
   									$t_percent = (intval($vote_quantity)/intval($voters_quantity)) * 100 ;
									$formated_general = number_format($t_percent, 2);
									} else {
   									 $formated_general = 0;
									}
									?>
						<span class="text">
							<h3><?php echo $formated_general; ?>%</h3>
							<p>BS in Mechanical Engineering</p>
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