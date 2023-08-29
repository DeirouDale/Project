<?php include 'voters_add.php'; ?> 
<?php include 'voters_delete.php'; ?> 
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
			<li class="active">
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
						<h1>Voters List</h1><hr>
					</div>
				</div>

				<div class = "candidates">
					<button class = "btn_addCandidates" id="pop-upButton"> ADD VOTEE</button>
					<button class = "btn_prtCandidates"> PRINT</button>
				</div>
			<div class="table-info">
				<table class= "content-table">
					<thead>
						<tr>
							<th>Student Number</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Course</th>
							<th>Year Level</th>
							<th>Password</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
					<?php
					$conn = mysqli_connect('localhost','root','','voting_system') or die('connection failed');


                    $sql = "SELECT * FROM voters";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);

                    if ($count>0) {
                    	while ($row=mysqli_fetch_assoc($res)) 
					{
						$id = $row['id'];
						$student_number = $row['student_number'];
						$firstname = $row['first_name'];
     					$lastname = $row['last_name'];
     					$course = $row['course'];
     					$year_level = $row['year_level'];
     					$password = $row['password'];
     					?>
     					<tr>
     						<td><?php echo $student_number;?></td>
     						<td><?php echo $firstname;?></td>
     						<td><?php echo $lastname;?></td>
     						<td><?php echo $course;?></td>
     						<td><?php echo $year_level;?></td>
     						<td><?php echo $password;?></td>
     						<td>
     							<a href="voters_edit.php?id=<?php echo $id; ?>" id="<?php echo $id;?>" class="btn_addCandidates"type ="delete">Edit</a></td> <td>
     							<a href="voters_delete.php?id=<?php echo $id; ?>" id="<?php echo $id;?>" class="btn_addCandidates"type ="delete">Delete</a>
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
		<div class = "pop-up">
				<div class= "close-btn">&times;</div>
				<div class= "form">
					<form method="POST">
					<h2>Add Voters</h2>
					<div class="form-elements">
						<label for= "first_name">First Name</label>
						<input type="text" id= "first_name" name= "first_name" required>
					</div>
					<div class="form-elements">
						<label for= "last_name">Last Name</label>
						<input type="text" id= "last_name" name= "last_name" required>
					</div>
					<div class="form-elements">
						<label for= "student_number">Student Number</label>
						<input type="text" id= "student_number" name= "student_number"required>
					</div>
					<div class="form-elements">
						<label for= "course">Course</label>
						<input type="text" id= "course" name= "course"required>
					</div>
					<div class="form-elements">
						<label for= "year_level">Year Level</label>
						<input type="number" id= "year_level" min = "1"  max = "5" value = "1" name= "year_level"required>
					</div>

					<div class="form-elements">
						<button class= "submit" name="submit" >Submit</label>
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