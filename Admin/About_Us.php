<?php
include("../connection.php");
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
			<li class = "active">
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
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Dashboard -->
			<div class="about_us">
				<div class = "info-container">
					<div class = "img-group">
						<img src = "../Img/img.jpg">
					</div>
					<div class = "head">
						<h2>About Us</h2>
						<div class = "con">
							<p>We are a group of passionate Computer Engineering students from Mariano Marcos State University. Driven by our shared enthusiasm for technology and democratic processes, we have come together to develop a specialized voting system for the College of Engineering. Our goal is to enhance the election process by providing a secure, user-friendly, and inclusive platform that empowers every student to participate and make their voice heard.</p>

							<p>With a strong focus on transparency and integrity, we have leveraged our technical skills and knowledge to design a voting system that ensures the confidentiality and accuracy of each vote. Our team has worked diligently to create an intuitive interface that simplifies the voting process for all users, regardless of their technical background. We are dedicated to continually improving and refining our system to meet the specific needs and preferences of the College of Engineering.</p>

							<div class = "below">
								<p>
								(Dale Panganiban,
								Aean Gabrielle Tayawa,
								Selwyne Christian Ponce,
								Kenric Catiwa,
								Dexter John Perdido,
								Ryan Adaya,
								Eldwin Janlord Pasion,
								Rhyan Jhames Agcaoili,
								Chyra Acosta,
								Don Angelo Sarabia,
								Andra Camille Cagat,
								Vincent Moratal)
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!-- Votes -->                      
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="../script.js"></script>
</body>
</html>