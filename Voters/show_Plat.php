<?php include '../connection.php';?>
<?php
		$id = $_POST['bookId'];

		$sql = "SELECT * FROM candidates WHERE id = " . $id;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
?> 
	<div class="form">
		<h2>Election Platform</h2>
		<div class="form-elements">
			<label><?php echo $row["platform"];?></label>
		</div>
	</div>