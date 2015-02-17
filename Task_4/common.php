<?php

function makeKey($email){
	return md5(encryptEmail($email) . md5($email));
}

function encryptEmail($val){
	return md5($email . SALT);
}

function encryptPhone($key, $phone){
	return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $phone, MCRYPT_MODE_CBC, md5($key)));
}

function decryptPhone($key, $encryptedPhone){
	return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($encryptedPhone), MCRYPT_MODE_CBC, md5($key)), "\0");
}

?>