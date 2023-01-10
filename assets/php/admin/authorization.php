<?php
session_start();

if (isset($_SESSION['adminLogged'])) {
    header("Location: /admin.php");
    die();
} else {
    $sentUsername = $_POST["username"];
    $sentPassword = $_POST["password"];

    require($_SERVER['DOCUMENT_ROOT'] . "/assets/php/db.php");

    $allAccounts = $fungame_db->query('SELECT * FROM accounts');

    $loggedIn = false;

    while ($acc = $allAccounts->fetch(PDO::FETCH_ASSOC)) {
        if ($acc['username'] == $sentUsername && password_verify($sentPassword, $acc['password'])) {
            $loggedIn = true;
            break;
        }
    }

    if ($loggedIn) {
        $_SESSION["adminLogged"] = "true";
        header("Location: /admin.php");
        die();
    } else {
        header("Location: /login.php");
        die();
    }
}
?>
