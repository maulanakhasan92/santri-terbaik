<?php
	include 'db/db_config.php';
	extract($_POST);
	$pass = md5($password);
	$sql = $db->select('*','admin')->where("username='$username' and password='$pass'");
	$check = $sql->count();
	if($check==1){
		foreach ($sql->get() as $data) {
			$id_user = $data['id'];
		}
		session_start();
		$_SESSION['id'] = $id_user;
		$_SESSION['nama'] = $username;
		header('location:index.php');
	} else {
		header('location:login.php?pesan=gagal');
	}
?>