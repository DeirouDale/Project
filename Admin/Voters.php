<?php include 'voters_add.php'; ?> 
<?php include 'voters_delete.php'; ?> 
<?php include '../connection.php';?>
<?php

if(isset($_POST['reset'])){
	$sql = "DELETE FROM votes";
	$res = mysqli_query($conn,$sql);
	$update_state = mysqli_query($conn, "UPDATE `voters` SET voted='No'");
	if($res && $update_state){
		header("location:Voters.php");
	}
}

?>
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
			<li class="active">
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
				<a href="About_Us.php">
					<i class='bx bxs-group' ></i>
					<span class="text">About Us</span>
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
						<h1>Voters List</h1><hr>
					</div>
				</div>

			<div class= sel-container>
				<form action="#" id="search-form">
    				<div class="form-input">
    					<div class = "search">
        					<input type="text" id="search-input" placeholder="Search here">
        					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        				</div>
				        <select id="course-filter">
				            <option value="All Courses">All Courses</option>
				            <option>BS in Agricultural and Biosystems Engineering</option>
				            <option>BS in Ceramics Engineering</option>
				            <option >BS in Chemical Engineering</option>
				            <option >BS in Civil Engineering</option>
				            <option >BS in Computer Engineering</option>
				            <option >BS in Electrical Engineering</option>
				            <option >BS in Electronics Engineering</option>
				            <option >BS in Mechanical Engineering</option>
				        </select>
        
				        <select id="voted-filter">
				            <option value="All">All</option>
				            <option value="Yes">Yes</option>
				            <option value="No">No</option>
				        </select>
    				</div>
				</form>
	    	</div>
				<div class = "candidates">
					<button class = "btn_addCandidates" id="pop-upButton"> Add Votee </button>
					<!--<button class = "btn_prtCandidates"> PRINT</button> -->
					<button  class = "btn_prtCandidates" onclick="generateRandomCharacters()">Generate and Update</button>
					<button class="btn_prtCandidates" onclick="printTable()">Print</button>
					<form method="POST" class="reset-btn">
						<button class = "btn_addCandidates" name="reset" class="btn_addCandidates-2" onclick="return confirm('Are you sure you want to reset the voters?')"> Reset Votes </button>
					</form>
				</div>
			<div class="table-info">
				<table id="user-table"class= "content-table">
					<thead>
						<tr>
							<th>Student Number</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Course</th>
							<th>Year Level</th>
							<th>Password</th>
							<th>Voted</th>
							<th>Tools</th>
						</tr>
					</thead>
					<tbody>
						<tr>
					<?php

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
						$voted = $row['voted'];
     					?>
     					<tr class="data-row">
     						<td><?php echo $student_number;?></td>
     						<td><?php echo $firstname;?></td>
     						<td><?php echo $lastname;?></td>
     						<td><?php echo $course;?></td>
     						<td><?php echo $year_level;?></td>
     						<td><?php echo $password;?></td>
							<td><?php echo $voted;?></td>
     						<td>
     							<?php
							    echo '<button id="pop-upButton' . $id . '" data-bookId="' . $id . '" class="update_vote")">UPDATE</button>';
							?>

     							<a href="voters_delete.php?id=<?php echo $id; ?>" id="<?php echo $id; ?>" class="btn_addCandidates-2" onclick="return confirm('Are you sure you want to delete this Voter?')">DELETE</a>

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
						<select class="form-elements" id="course" name="course">
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
						<label for= "year_level">Year Level</label>
						<input type="number" id= "year_level" min = "1"  max = "5" value = "1" name= "year_level"required>
					</div>

					<div class="form-elements">
						<button class= "submit" name="submit" >Submit</label>
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
<script>
    // Search functionality
    document.getElementById('search-form').addEventListener('submit', function (event) {
        event.preventDefault();
        var searchValue = document.getElementById('search-input').value.trim().toLowerCase();
        var selectedCourse = document.getElementById('course-filter').value;
        var selectedVoted = document.getElementById('voted-filter').value;
        filterTable(searchValue, selectedCourse, selectedVoted);
    });

    // Function to filter the table based on the search query, course, and voted status
    function filterTable(searchValue, selectedCourse, selectedVoted) {
        var rows = document.querySelectorAll('#user-table tbody tr');
        rows.forEach(function (row) {
            var columns = row.querySelectorAll('td');
            var found = false;
            columns.forEach(function (column) {
                if (column.textContent.toLowerCase().includes(searchValue)) {
                    found = true;
                }
            });
            if (selectedCourse && selectedCourse !== 'All Courses') {
                var courseColumn = row.querySelector('td:nth-child(4)');
                if (courseColumn && courseColumn.textContent.trim() !== selectedCourse) {
                    found = false;
                }
            }
            if (selectedVoted && selectedVoted !== 'All') {
                var votedColumn = row.querySelector('td:nth-child(7)');
                if (votedColumn && votedColumn.textContent.trim() !== selectedVoted) {
                    found = false;
                }
            }
            row.style.display = found ? '' : 'none';
        });
    }
</script>
<script>
    function printTable() {
        const searchValue = document.getElementById('search-input').value;
        const selectedCourse = document.getElementById('course-filter').value;
        const selectedVoted = document.getElementById('voted-filter').value;

        const printTableUrl = `print_table.php?searchValue=${searchValue}&course=${selectedCourse}&voted=${selectedVoted}`;
        window.open(printTableUrl, '_blank');
    }
</script>



</body>
</html>

</body>
</html>