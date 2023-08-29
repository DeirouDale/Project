<?php include '../connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
				<a href="Election-Title.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Election Title</span><hr>
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
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Dashboard -->

			<?php
				$sql = "SELECT * FROM election_title";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);
					$row=mysqli_fetch_assoc($res);
						$id = $row['id'];
     					$title = $row['title'];
					
   ?> 
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>Election Title</h1><hr>
					</div>
				</div>
			</div>
			<div class="title">
				<form action="election_title_edit.php" method="POST">
					<h2>Update Election Title</h2>
					<div class="form-element">
						<input type="text" name="title" placeholder="<?Php echo $title;?>">
					</div>
					<input type="hidden" name="id" value= "1" > 
					<input type="submit" value="Update">
				</form>
				<br><br>
			</div>
			<div class="current-title">
				<h1>Current Title: "<?Php echo $title;?>"</h1>
			</div>
		</main>
	</section>
	<script src="../script.js"></script>

		<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>