<?php
require_once 'config.php';
require_once 'db_connect.php';
require_once 'common.php';

// Форма заполнена
if (isset($_POST['email']) && isset($_POST['phone'])){
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$Errors[] = 'Incorrect e-mail';
	}
	
	if (empty($phone)){
		$Errors[] = 'Enter phone';
	}
	
	if (empty($Errors)){
		// Кодируем e-mail
		$encryptedEmail = encryptEmail($email);
		// Получаем ключ для кодировки телефона
		$key = makeKey($email);
		// Кодируем телефон
		$encryptedPhone = encryptPhone($key, $phone);
		
		$sth = $db->prepare("INSERT INTO `test_users` (`email`, `phone`) VALUES (?, ?)");
		
		$sth->execute(array($encryptedEmail, $encryptedPhone));
	}
}

include 'view/new_user.php';
?>