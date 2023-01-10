<?php

$user = 'neofos_fungame';
$password = 'MFGInspa4';
$db = 'neofos_fungame';
$host = '92.53.96.243';
$charset = 'utf8';

$fungame_db = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);

?>