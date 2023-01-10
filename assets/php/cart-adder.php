<?php
$prdId = $_GET['id'];
$prdPrice = $_GET['price'];
$prdAmount = $_GET['amount'];

$time = time() + 604800; /* Неделя */
$value_exists = false;

if (isset($_COOKIE['cart_prd'])) {
    foreach ($_COOKIE['cart_prd'] as $name => $value) {
        if ($name == $prdId) {
            $pieces = explode('KEKL', $value);
            $value_exists = true;
            $newAmount = (int)$pieces[1] + (int)$prdAmount;
            setcookie('cart_prd['.$name.']', $prdPrice . 'KEKL' . $newAmount, $time, "/");
            break;
        }
    }
}

if (!$value_exists) {
    setcookie('cart_prd['.$prdId.']', $prdPrice . 'KEKL' . $prdAmount, $time, "/");
}

header("Location: /product.php?id=" . $prdId);
die();
