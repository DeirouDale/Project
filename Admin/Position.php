<?php 
include 'postion_add.php';
include 'position_delete.php';
?> 
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
			<li class= "active">
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
				<div class="head-title">
					<div class="left">
						<h1>Office</h1><hr>
					</div>
				</div>
				<div class = "candidates">
					<button class = "btn_addCandidates" id = "pop-upButton">ADD OFFICE</button>
				</div>
			</div>
			<div class="table-info">
				<table class= "content-table">
					<thead>
						<tr>
							<th>Office</th>
							<th>Label</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>

						</tr>
						<tr>
					<?php

                    $sql = "SELECT * FROM position";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);

                    if ($count>0) {
                    	while ($row=mysqli_fetch_assoc($res)) 
					{
						$id = $row['id'];
						$positions = $row['position'];
						$label = $row['label'];
     					?>
     					<tr>
     						<td><?php echo $positions;?></td>
     						<td><?php echo $label;?></td>
     						<td style="width: 300px;">
     							<form method="post">
     							
								<?php
                          			echo '<button type= "button" id="pop-upButton' . $id . '" data-bookId="' . $id . '" class="update_pos">UPDATE</button>';

                          		?>
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<input type="hidden" name="positions" value="<?php echo $positions; ?>">
									<button type="submit" name="delete" class="btn_addCandidates-2" onclick="return confirm('Are you sure you want to delete this position? All votes will be reseted if you continue')">Delete</button>

								</form>
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
					<form method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to add the position?')">
					<h2>Add Office</h2>
					<div class="form-elements">
						<label for= "positions">Office</label>
						<input type="text" id= "positions" name="positions" required>
					</div>
					<div class="form-elements">
					<label for= "label">Year Level</label>
					<select class="form-elements" id="label" name="label">
								<option value="" selected>- Select -</option>
								<option>General</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
					</select>
					</div>
					<div class="form-elements">
						<button class= "Submit" id = "add" name="add">Submit</label>
						</form>
					</div>
					
				</div>
		</div>
		<div class = "pop-up-2">
			<div class= "close-btn">&times;</div>
			<div class= "form">
			</div>
		</div>
	<script src="../script.js"></script>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>