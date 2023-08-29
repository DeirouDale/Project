<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

	<link rel="stylesheet" href="style3.css">

	<title>COE-Voting-System</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs'> <img class= "logo-img" src = "C:\xamppp\htdocs\Project\Img\COE.png" width=60px height=60px></i>
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
					<span class="text">Positions</span>
				</a>
			</li>
			<li>
				<a href="Ballot-Position.php">
					<i class='bx bxs-box' ></i>
					<span class="text">Election Platform</span>
				</a>
			</li>
			<li>
				<a href="Election-Title.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Election Title</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Sign Out</span>
				</a>
			</li>
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
					<input type="search" placeholder="Search here">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<a href="#" class="profile">
				<img src="C:\xamppp\htdocs\Project\Img\user.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Dashboard -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>Dashboard</h1><hr>
					</div>
				</div>

				<ul class="box-info">
					<li>
					<?php 

					$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');

					$sql ="SELECT * FROM position";

					$res = mysqli_query($conn, $sql);

			        $count = mysqli_num_rows($res);
			        ?>
						<i class='bx bxs-user-detail'></i>
						<span class="text">
							<h3><?php echo $count; ?></h3>
							<p>No. of Positions</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-group' ></i>
					<?php 

					$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');

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
							<h3>#</h3>
							<p>Total Votes</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-user-check' ></i>
						<span class="text">
							<h3>#</h3>
							<p>No. Voters voted</p>
						</span>
					</li>
				</ul>
			</div>
		</main>
		<!-- Votes -->                      
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="script.js"></script>
</body>
</html>