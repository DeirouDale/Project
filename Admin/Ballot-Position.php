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
			<li class="active">
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
				<img src="C:\Users\acer\Desktop\HTML CSS practice\Project\Img\user.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Dashboard -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>Election Platform</h1><hr>
					</div>
				</div>
			</div>
				<button class = "btn_addCandidates" id = "pop-upButton">ADD PLATFORM</button>
				<button class = "btn_addCandidates" id = "refresh">Refresh</button>
			<div class="container">
				<div class="E-platform">
					<h1>Select Election Title</h1> <!--Dynamic -->

				</div>
			</div>
		</main>
	</section>
	<div class = "pop-up">
				<div class= "close-btn">&times;</div>
				<div class= "form">
					<h2>Add Platform</h2>
					<div class="form-elements">
						<input type="text" id= "Fname" placeholder= "Search Candidate" required>
					<div class="form-elements">
						<label for= "LName">Candidate</label>
						<input type="text" id= "Lname" disabled>
					</div>
					<div class="form-elements">
						<label for= "LName">Position</label>
						<input type="text" id= "Lname" disabled>
					</div>
					<div class="form-elements">
						<label for= "LName">Election Platform</label>
						<div class = "platform">
							<textarea class= "text" id="platform"></textarea>
						</div>
					</div>
					<div class="form-elements">
						<button class= "Submit">Submit</label>
					</div>
				</div>
		</div>
	<script src="../script.js"></script>
</body>
</html>