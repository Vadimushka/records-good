<?php
include_once "sys/inc/start.php";

$status = false;

if(isset($_POST['login']) && isset($_POST['password'])){
	if(!empty($_POST['login']) && !empty($_POST['password'])){
		$login = (string) $_POST['login'];
		$password = (string) $_POST['password'];
		
		$q = $db->prepare("SELECT * FROM `users` WHERE `login` = ? LIMIT 1");
		$q->execute([$login]);
		
		if(!$row = $q->fetch()){
			echo "Логин " . $login . " не зарегистрирован";
		} elseif (pass_hash($password) !== $row['password']) {
			echo "Вы ошиблись при вводе пароля";
		} else {
			$_SESSION['admin'] = $login;
			$_SESSION['group'] = $row['group'];
			$status = true;
		}
		
	} else {
		echo "Введите логин/пароль";
	}
} else {
	header("Location: /");
}

if($status){
	header("Location: /");
}