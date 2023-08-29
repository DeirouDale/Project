<?php include '../connection.php';?>
<?php


	if(isset($_POST['add'])){
		$positions = $_POST['positions'];
		$label = $_POST['label'];
		$col_positions = str_replace(' ', '',$positions);
		$modified_col_positions = preg_replace('/-/', '_', $col_positions);
		$final_col_positions = "C". $modified_col_positions;

		$insert = mysqli_query($conn, "INSERT INTO position (position, columnName, label) VALUES ('$positions', '$final_col_positions','$label')") or die('query failed');
		$add_col = mysqli_query($conn, "ALTER TABLE `votes` ADD $final_col_positions varchar(50)") or die('query failed');

		 if($insert && $add_col){
			header("location:Position.php");
		 }
		 else{
			header("location:Candidates.php");
		 }
		 $sql = "DELETE FROM votes";
			$res = mysqli_query($conn,$sql);
			$update_state = mysqli_query($conn, "UPDATE `voters` SET voted='No'");
	}

?>