<?php include 'candidates_add.php'; ?> 
<?php include '../connection.php';?>
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
			<li class="active">
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
				<img src="../Img/user.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- candidates-->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>Candidates</h1><hr>
					</div>
				</div>

				<div class = "candidates">
					<button class = "btn_addCandidates" id="pop-upButton"> ADD CANDIDATE</button>
					<button class = "btn_prtCandidates"> PRINT</button>
				</div>
			</div>
			<div class="table-info">
				<table class= "content-table">
					<thead>
						<tr>
							<th>Profile</th>
							<th>Student Number</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Course</th>
							<th>Position</th>
							<th>Platform</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
					<?php

                     $sql = "SELECT *, candidates.id AS canid FROM candidates LEFT JOIN position ON position.id=candidates.position_id ";
                    $query = $conn->query($sql);
										$res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);

                    if ($count>0) {
                    while($row = $query->fetch_assoc()){
                    	$id = $row['id'];?>
                    	<?php
                      $image = (!empty($row['profile'])) ? '../Candidate/'.$row['profile'] : '.../Project/Candidate/profile.jpg';?>
                      <?php
                      echo "
                        <tr>
                          <td>
                            <img src='".$image."' width='30px' height='30px'>
                            <a data-id='".$row['canid']."'><span class='fa fa-edit'></span></a>
                          </td>
                          ";?>
                          <?php
                          $id = $row['canid'];
                          $student_number = $row['student_number'];
                         	$lastname = $row['last_name'];
                         	$firstname = $row['first_name'];
                         	$position = $row['position'];
                         	$course = $row['course'];
                         	$platform = $row['platform'];

                         	?>
                          <td><?php echo $student_number; ?></td>
		                  <td><?php echo $firstname; ?></td>
						  <td><?php echo $lastname; ?></td>
                          <td><?php echo $course; ?></td>
                          <td><?php echo $position; ?></td>
                          <td><?php echo $platform; ?></td>
                          <td>
							<a href="candidates_edit.php?id=<?php echo $id; ?>" id="<?php echo $id;?>" class="btn_addCandidates-2"type ="delete">Edit</a>
     						<a href="candidates_delete.php?id=<?php echo $id; ?>" id="<?php echo $id;?>" class="btn_addCandidates-2"type ="delete">Delete</a>
                          </td>
                        </tr>
                      
     					<?php
     				}
               }
  ?>

						</tr>
					</tbody>
				</table>
			</div>
		</main>
	</section>