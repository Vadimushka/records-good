<?php
include_once "sys/inc/start.php";

if(!$_SESSION['admin']){
	header("Location: records.php");
	exit;
}

if(isset($_GET['operation'])){
	switch ((string) $_GET['operation']) {
		case 'delete_storehouse':
			$db->query("DELETE FROM `storehouse` WHERE `id` > 1");

			header("Location: /records.php");
			break;
		case 'delete':
			if(isset($_GET['id'])){
				$q = $db->prepare("DELETE FROM `list_products` WHERE `id` = ? ");
				$q->execute(Array($_GET['id']));

				header("location: records.php");
			}

			break;
		case 'archive':
			if(isset($_GET['id'])){
				$q = $db->prepare("UPDATE `list_products` SET `id_storehouse` = 1 WHERE `id` = ? ");
				$q->execute(Array($_GET['id']));

				header("location: records.php");
			}
			break;
		case 'update':
			if(isset($_GET['id'])){
				$url = "Location: http://{$_SERVER['HTTP_HOST']}/records.update.php?id={$_GET['id']}";
				header($url);
			}
			break;
		
		default:
			break;
	}
}