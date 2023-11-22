<?php
	include 'db/db_config.php';
    extract($_POST);
    
    //echo $id;

	if($db->update('santri',"nama='$nama',kelas='$kelas'")->where("id_santri='$id'")->count()==1){
		header('location:tampil_santri.php?pesan=ok');
	} else {
		header('location:tampil_santri.php');
	}
?>