<?php
include("../connection.php");
session_start();
date_default_timezone_set('Asia/Manila'); // Set the timezone


// Fetch table data from the database
$query = "SELECT table_no, table_name FROM list_of_tables ORDER BY table_no";
$result = mysqli_query($conn, $query);
$tables = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get today's date
$today = getdate();
$current_year = $today['year'];
$current_month = str_pad($today['mon'], 2, '0', STR_PAD_LEFT); // Ensure two-digit format
$current_day = str_pad($today['mday'], 2, '0', STR_PAD_LEFT); // Ensure two-digit format
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include '../Admin/constants/style.php'; ?>
	<title>SDO Batac LRMS</title>
</head>
<body>

	 <?php include("../Admin/constants/side_bar.php"); ?>

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php include("../Admin/constants/nav.php"); ?>	
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Learners and Education Programs -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>Learners and Education Programs</h2><hr>
					</div>
				</div>
				<ul class="box-info-2">
					<?php foreach ($tables as $table): ?>
						<?php if ($table['table_no'] >= 1 && $table['table_no'] <= 9): ?>
							<li>
								<a href="../Admin/Tables/Table_<?php echo $table['table_no']; ?>.php?year=<?php echo $current_year; ?>-<?php echo $current_year + 1; ?>&month=<?php echo $current_month; ?>&day=<?php echo $current_day; ?>">
									<i class='bx bxs-group'></i>
									<span class="text">
										<p>Table <?php echo $table['table_no']; ?>. <?php echo $table['table_name']; ?></p>
									</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- Teachers and Personnel -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>Teachers and Personnel</h2><hr>
					</div>
				</div>
				<ul class="box-info-2">
					<?php foreach ($tables as $table): ?>
						<?php if ($table['table_no'] >= 10 && $table['table_no'] <= 18): ?>
							<li>
								<a href="../Admin/Tables/Table_<?php echo $table['table_no']; ?>.php?year=<?php echo $current_year; ?>-<?php echo $current_year + 1; ?>&month=<?php echo $current_month; ?>&day=<?php echo $current_day; ?>">
									<i class='bx bxs-group'></i>
									<span class="text">
										<p>Table <?php echo $table['table_no']; ?>. <?php echo $table['table_name']; ?></p>
									</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- Technology and Equipment -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>Technology and Equipment</h2><hr>
					</div>
				</div>
				<ul class="box-info-2">
					<?php foreach ($tables as $table): ?>
						<?php if ($table['table_no'] >= 19 && $table['table_no'] <= 23): ?>
							<li>
								<a href="../Admin/Tables/Table_<?php echo $table['table_no']; ?>.php?year=<?php echo $current_year; ?>-<?php echo $current_year + 1; ?>&month=<?php echo $current_month; ?>&day=<?php echo $current_day; ?>">
									<i class='bx bxs-group'></i>
									<span class="text">
										<p>Table <?php echo $table['table_no']; ?>. <?php echo $table['table_name']; ?></p>
									</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- Financial and Resource Management -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>Financial and Resource Management</h2><hr>
					</div>
				</div>
				<ul class="box-info-2">
					<?php foreach ($tables as $table): ?>
						<?php if ($table['table_no'] == 27): ?>
							<li>
								<a href="../Admin/Tables/Table_<?php echo $table['table_no']; ?>.php?year=<?php echo $current_year; ?>-<?php echo $current_year + 1; ?>&month=<?php echo $current_month; ?>&day=<?php echo $current_day; ?>">
									<i class='bx bxs-group'></i>
									<span class="text">
										<p>Table <?php echo $table['table_no']; ?>. <?php echo $table['table_name']; ?></p>
									</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- Health and Nutrition -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>Health and Nutrition</h2><hr>
					</div>
				</div>
				<ul class="box-info-2">
					<?php foreach ($tables as $table): ?>
						<?php if ($table['table_no'] >= 28 && $table['table_no'] <= 32): ?>
							<li>
								<a href="../Admin/Tables/Table_<?php echo $table['table_no']; ?>.php?year=<?php echo $current_year; ?>-<?php echo $current_year + 1; ?>&month=<?php echo $current_month; ?>&day=<?php echo $current_day; ?>">
									<i class='bx bxs-group'></i>
									<span class="text">
										<p>Table <?php echo $table['table_no']; ?>. <?php echo $table['table_name']; ?></p>
									</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- School Facilities and Services -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>School Facilities and Services</h2><hr>
					</div>
				</div>
				<ul class="box-info-2">
					<?php foreach ($tables as $table): ?>
						<?php if ($table['table_no'] >= 24 && $table['table_no'] <= 27): ?>
							<li>
									<a href="../Admin/Tables/Table_<?php echo $table['table_no']; ?>.php?year=<?php echo $current_year; ?>-<?php echo $current_year + 1; ?>&month=<?php echo $current_month; ?>&day=<?php echo $current_day; ?>">
									<i class='bx bxs-group'></i>
									<span class="text">
										<p>Table <?php echo $table['table_no']; ?>. <?php echo $table['table_name']; ?></p>
									</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- Disasters and Emergency Management -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h2>Disasters and Emergency Management</h2><hr>
					</div>
				</div>
				<ul class="box-info-2">
					<?php foreach ($tables as $table): ?>
						<?php if ($table['table_no'] >= 34 && $table['table_no'] <= 36): ?>
							<li>
								<a href="../Admin/Tables/Table_<?php echo $table['table_no']; ?>.php?year=<?php echo $current_year; ?>-<?php echo $current_year + 1; ?>&month=<?php echo $current_month; ?>&day=<?php echo $current_day; ?>">
									<i class='bx bxs-group'></i>
									<span class="text">
										<p>Table <?php echo $table['table_no']; ?>. <?php echo $table['table_name']; ?></p>
									</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="../script.js"></script>
</body>
</html>
