<?php include 'candidates_add.php'; ?> 
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
			<!-- candidates-->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>Candidates</h1><hr>
					</div>
				</div>

				<div class = "candidates">
					<button class = "btn_addCandidates" id="pop-upButton"> ADD CANDIDATE</button>
					<!--<button class = "btn_prtCandidates"> PRINT</button> -->
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
							<th>Office</th>
							<th>Tagline</th>
							<th>Tools</th>
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
                          <td style="width: 300px;">
						    <?php
						        echo '<button id="pop-upButton' . $id . '" data-bookId="' . $id . '" class="update_cad">UPDATE</button>';
						    ?>
						    <a href="candidates_delete.php?id=<?php echo $id; ?>" id="<?php echo $id; ?>" class="btn_addCandidates-2" type="delete" onclick="return confirm('Are you sure you want to delete this candidate? All votes will be reseted if you continue')">DELETE</a>
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

	<div class="pop-up">
	<div class="close-btn">&times;</div>
	<div class="form">
		<form method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to add the candidate? All votes will be reseted if you continue')">
			<h2>Add Candidates</h2>

			<div class="form-elements">
				<label for="Fname">First Name</label>
				<input type="text" id="Fname" name="Fname" required>
			</div>
			<div class="form-elements">
				<label for="Lname">Last Name</label>
				<input type="text" id="Lname" name="Lname" required>
			</div>
			<div class="form-elements">
				<label for="SNum">Student Number</label>
				<input type="text" id="SNum" name="SNum" required>
			</div>
			<div class="form-elements">
				<label for="Course">Course</label>
				<select class="form-elements" id="Course" name="Course">
					<option value="" selected>- Select -</option>
					<option>BS in Agricultural and Biosystems Engineering</option>
					<option>BS in Ceramics Engineering</option>
					<option>BS in Chemical Engineering</option>
					<option>BS in Civil Engineering</option>
					<option>BS in Computer Engineering</option>
					<option>BS in Electrical Engineering</option>
					<option>BS in Electronics Engineering</option>
					<option>BS in Mechanical Engineering</option>
				</select>
			</div>
			<div class="form-elements">
				<label for="Position">Positions</label>
				<select class="form-elements" id="Position" name="Position">
					<option value="" selected>- Select -</option>
					<?php
					$sql = mysqli_query($conn, "SELECT * FROM position");
					$row = mysqli_num_rows($sql);
					while ($row = mysqli_fetch_array($sql)) {
						echo "<option value='" . $row['id'] . "'>" . $row['position'] . "</option>";
					}
					?>
				</select>
			</div>
			<div class="form-elements">
				<label for="photo">Photo</label>
				<input type="file" id="photo" name="image">
			</div>
			<div class="form-elements">
				<label for="platform">Tagline</label>
				<textarea class="form-control" id="platform" name="platform" rows="5" cols="60"></textarea>
			</div>
			<div class="form-elements">
				<button class="Submit" name="add">Submit</button>
			</div>
		</form>
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