<?php
$to      = 'email@gmail.com';
$subject = 'Был сделан заказ!';
$message = 'Я, ' . $_POST['name'] . ', сделал заказ на сумму ' . $_POST['totalZakazCost'] . ' ₽.';
$headers = 'От: ' . $_POST['email'];;
mail($to, $subject, $message, $headers);

$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
foreach ($cookies as $cookie) {
	$parts = explode('=', $cookie);
	$name = trim($parts[0]);
	if ($name != 'PHPSESSID') {
		setcookie($name, '', time() - 1000);
		setcookie($name, '', time() - 1000, '/');
	}
}

header("Location: /cart.php");
die();