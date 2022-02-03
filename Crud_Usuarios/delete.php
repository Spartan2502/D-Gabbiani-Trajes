<?php 

	include_once 'database.php';
	$db = new Database();
	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];
		$delete=$db->connect()->prepare('DELETE FROM clientes WHERE id=:id');
		$delete->execute(array(
			':id'=>$id
		));
		header('Location: menu.php');
	}else{
		header('Location: menu.php');
	}
 ?>