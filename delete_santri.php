<?php
	include 'db/db_config.php';
	$id = $_GET['id'];
	if($db->delete('santri')->where('id_santri='.$id)->count() == 1){
		header('location:tampil_santri.php');
	} else {
		header('location:tampil_santri.php?error_msg=error_delete');
	}
?>