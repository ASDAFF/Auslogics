<?php
require_once 'config.php';
require_once 'db_connect.php';
require_once 'common.php';

// Форма заполнена
if (isset($_POST['email'])){
	$email = $_POST['email'];
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$Errors[] = 'Incorrect e-mail';
	}
	
	if (empty($Errors)){
		// Кодируем e-mail
		$encryptedEmail = encryptEmail($email);
		
		$sth = $db->prepare("SELECT * FROM `test_users` WHERE `email` = ?");
		
		$sth->execute(array($encryptedEmail));
		
		$User = $sth->fetch();

		// Получаем ключ для декодирования телефона
		$key = makeKey($email);
		
		$decryptedPhone = decryptPhone($key, $User['phone']);
		
		$headers = 'From: no-reply@r869.ru' . "\r\n" .
					'Reply-To: no-reply@r869.ru' . "\r\n" .
					'X-Mailer: Test_4';

		$result = mail($email, 'Your phone', 'Your phone: '. $decryptedPhone, $headers);
	}
}

include 'view/restore_phone.php';
?>