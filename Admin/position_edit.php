<?php include '../connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>COE-Voting-System</title>
</head>
<body>
	<?php
	$id = isset($_POST['bookId']) ? mysqli_real_escape_string($conn, $_POST['bookId']) : '';
	
	if (!empty($id)) {
		$sql = "SELECT * FROM position WHERE id = $id";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);

		while ($row = mysqli_fetch_assoc($res)) {
			$id = $row['id'];
			$positions = $row['position'];
			$label = $row['label'];
		?>
		<?php
	}
}
	?>
		<div class="form">
			<form method="POST" enctype="multipart/form-data" action="position_edit.php?id=<?php echo $id; ?>" onsubmit="return confirm('Are you sure you want to edit this position?')">
				<h2>Edit Office</h2>
				<div class="form-elements">
					<label for="positions">Office</label>
					<input type="text" id="positions" name="positions" value="<?php echo $positions ?>" required>
				</div>
				<div class="form-elements">
					<label for="restriction">Label</label>
					<select class="form-elements" id="label" name="label">
						<option value="<?php echo $label; ?>" selected><?php echo $label ?></option>
						<option>General</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</div>
				<div class="form-elements">
					<button class="btn_addCandidates" name="edit">Edit</button>
				</div>
			</form>
		</div>


	<?php 
	if (isset($_POST['edit'])) {
	 	$id = $_GET['id'];
		$positions = $_POST['positions'];
		$label = $_POST['label'];

		$select_col = mysqli_query($conn, "SELECT * FROM position WHERE id='$id'");
		$fetch_col = mysqli_fetch_assoc($select_col);
		$prev_position = $fetch_col['columnName'];

		$col_positions = str_replace(' ', '',$positions);
		$modified_col_positions = preg_replace('/-/', '_', $col_positions);
		$final_col_positions = "C". $modified_col_positions;

		$update_col = mysqli_query($conn, "ALTER TABLE votes CHANGE $prev_position $final_col_positions varchar(50);");

		$sql = "UPDATE `position` SET position = '$positions', columnName = '$final_col_positions', label = '$label' WHERE id = '$id'";
		$res = mysqli_query($conn, $sql);

		$sql2 = "DELETE FROM votes";
		$res = mysqli_query($conn, $sql2);
		$update_state = mysqli_query($conn, "UPDATE voters SET voted='No'");
		header('location: Position.php');
	}
	?>

	<script src="script.js"></script>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
</body>
</html>