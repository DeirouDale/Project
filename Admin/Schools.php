
<?php
session_start();
include("../connection.php");

$schools = mysqli_query($conn, "SELECT * FROM schools ORDER BY school_name ASC");

?>
<body>

	 <!-- SIDEBAR -->
	 <?php include '../Admin/constants/style.php'; ?>
	 <?php include '../Admin/constants/side_bar.php'; ?>
    <!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
	<?php include("../Admin/constants/nav.php"); ?>	
		<!-- MAIN -->
		<main>
			<!-- Dashboard -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title" id="name2">
					<div class="left">
						<h1>Schools</h1>
					</div>
				</div>
			</div>
			<hr>

			<ul class="box-info">
				<?php while ($school = mysqli_fetch_assoc($schools)): ?>
					<li>
						<a href="School_info.php?school_id=<?= $school['school_id'] ?>">
							<i><img src="../Img/school_logos/<?= $school['logo'] ?>.png" width="80px" height="80px"></i>
							<span class="text">
								<h3><?= $school['school_name'] ?></h3>
								<p>School ID: <?= $school['school_id'] ?></p>
							</span>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="../script.js"></script>
</body>
</html>
