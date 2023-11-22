<?php
	include 'db/db_config.php';
	extract($_POST);
	$ids = array();
	foreach($_POST['place'] as $val)
	{
	$ids[] = (int) $val;
	}
	echo $ids = implode(',', $ids);
	
	if($db->insert('nilai',"'','$id_santri',$ids")->count() == 1){
		header('location:input_tpa.php?pesan=ok');
	}
	
?>