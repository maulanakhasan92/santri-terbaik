<?php
	include 'db/db_config.php';
	extract($_POST);
	//print_r($_POST);
	$n = 0;
	foreach ($db->select('kriteria','kriteria')->get() as $c) {
		 $k[$n] = $c['kriteria'];
		 $n++;
	}
	$data = [];
	for ($i=0; $i < count($kriteria) ; $i++) { 
		array_push($data,$k[$i].'='.$kriteria[$i]);
	}
	$data = implode(',', $data);
	if($db->update('nilai',$data)->where("id_santri='$id'")->count()==1){
		header('location:tampil_tpa.php?pesan=ok');
	} else {
		echo "update gagal";
	}
?>