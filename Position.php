<?php include 'postion_add.php'; ?> 

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
			<i class='bx bxs'> <img class= "logo-img" src = "C:\Users\acer\Desktop\HTML CSS practice\Project\Img\COE.png" width=60px height=60px></i>
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
			<li class= "active">
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
						<h1>Positions</h1><hr>
					</div>
				</div>
				<div class = "candidates">
					<button class = "btn_addCandidates" id = "pop-upButton"> ADD POSITIONS</button>
				</div>
			</div>
			<div class="table-info">
				<table class= "content-table">
					<thead>
						<tr>
							<th>Position</th>
							<th>Number of Candidates</th>
							<th>Restriction</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>

						</tr>
						<tr>
					<?php
					$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');


                    $sql = "SELECT * FROM position";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);

                    if ($count>0) {
                    	while ($row=mysqli_fetch_assoc($res)) 
					{
						$id = $row['id'];
						$positions = $row['position'];
						$number_of_candidates = $row['number_of_candidates'];
						$restriction = $row['restriction'];
     					?>
     					<tr>
     						<td><?php echo $positions;?></td>
     						<td><?php echo $number_of_candidates;?></td>
     						<td><?php echo $restriction;?></td>
     						<td>
     							<a href="position_edit.php?id=<?php echo $id; ?>" id="<?php echo $id;?>" class="btn_addCandidates"type ="delete">Edit</a></td> <td>
     							<a href="position_delete.php?id=<?php echo $id; ?>" id="<?php echo $id;?>" class="btn_addCandidates"type ="delete">Delete</a>
     						</td>
     					</tr>
     					<?php
     				}
               }
  ?>
					</tbody>
				</table>	
			</div>
		</main>
	</section>  



		<div class = "pop-up" id = "pop-up">
				<div class= "close-btn">&times;</div>
				<div class= "form">
					<form method="POST">
					<h2>Add Positions</h2>
					<div class="form-elements">
						<label for= "position">Positions</label>
						<input type="text" id= "positions" name="positions" required>
					</div>
					<div class="form-elements">
						<label for= "LName">Number of Candidates</label>
						<input type="number" id= "number_of_candidates" name="number_of_candidates" min = "1" value = "1" required >
					</div>
					<div class="form-elements">
						<label for= "restriction">Restriction</label>
						<input type="text" id= "restriction" name="restriction" required>
					</div>
					<div class="form-elements">
						<button class= "Submit" id = "add" name="add">Submit</label>
						</form>
					</div>
				</div>
		</div>
	<script src="script.js"></script>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>