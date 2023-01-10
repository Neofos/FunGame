<?php
$prdId = $_GET['id'];
setcookie('cart_prd['.$prdId.']', null, -1, "/");

header("Location: /cart.php");
die();