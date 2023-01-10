<?php
require($_SERVER['DOCUMENT_ROOT'] . "/assets/php/admin/admin-db.php");

if (isset($_POST["game-id"]) && isset($_POST["percent"]) && isset($_POST["new-price"])) {
    $game_id = $db_admin->real_escape_string($_POST["game-id"]);
    $percent = $db_admin->real_escape_string($_POST["percent"]);
    $new_price = $db_admin->real_escape_string($_POST["new-price"]);

    $sql = "INSERT INTO discounts (Product, Percent, NewPrice) VALUES
    ('$game_id', '$percent', '$new_price')";
    if ($db_admin->query($sql)) {
        header('Location: /admin.php');
        die();
    } else {
        echo "Ошибка: " . $db_admin->error;
    }
} else {
    echo "Ошибка: не все отправилось (поч)";
}
