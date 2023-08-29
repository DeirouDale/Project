<?php include '../connection.php';?>
<?php


	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$positions = $_POST['positions'];

		$res = mysqli_query($conn,"DELETE FROM position WHERE id=$id");
		$col_positions = str_replace(' ', '',$positions);
		$modified_col_positions = preg_replace('/-/', '_', $col_positions);
		$final_col_positions = "C". $modified_col_positions;

		$res_col = mysqli_query($conn,"ALTER TABLE `votes` DROP COLUMN $final_col_positions") or die('query failed');

		if($res && $res_col){
			header('location:Position.php');
		}
		$sql = "DELETE FROM votes";
			$res = mysqli_query($conn,$sql);
			$update_state = mysqli_query($conn, "UPDATE `voters` SET voted='No'");
	}
		
 ?>