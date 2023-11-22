<?php
	include 'db/db_config.php';
	extract($_POST);
	if($db->insert('santri',"'','$nama','$kelas'")->count() == 1){
		header('location:input_santri.php?pesan=ok');
	}
?>