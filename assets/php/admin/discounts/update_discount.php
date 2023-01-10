<?php
require($_SERVER['DOCUMENT_ROOT'] . "/assets/php/admin/admin-db.php");

if (
    (isset($_POST["percent"]) || isset($_POST["new-price"])) && isset($_GET["id"])
) {
    $percent = $db_admin->real_escape_string($_POST["percent"]);
    $new_price = $db_admin->real_escape_string($_POST["new-price"]);
    $id = $_GET['id'];

    $sql = "UPDATE discounts SET ";

    if ($percent != '') {
        $sql .= "Percent = '$percent', ";
    }
    if ($new_price != '') {
        $sql .= "NewPrice = '$new_price', ";
    }

    $sql = rtrim($sql, ", ");

    $sql .=  " WHERE discounts.ID = '$id'";

    if ($db_admin->query($sql)) {
        header('Location: /admin.php');
        die();
    } else {
        echo "Ошибка: " . $db_admin->error;
    }
} else {
    echo "Ошибка";
}
