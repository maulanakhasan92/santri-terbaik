<?php
	include 'db/db_config.php';
	$id = $_GET['id'];
	if($db->delete('nilai')->where('id_santri='.$id)->count() == 1){
		header('location:tampil_tpa.php');
	} else {
		header('location:tampil_tpa.php?error_msg=error_delete');
	}
?>