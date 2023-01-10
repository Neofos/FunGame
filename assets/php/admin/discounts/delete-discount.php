<?php
require($_SERVER['DOCUMENT_ROOT'] . "/assets/php/admin/admin-db.php");

if (isset($_GET['id'])) {
    $sql = mysqli_query($db_admin, "DELETE FROM discounts WHERE ID = {$_GET['id']}");
    if ($sql) {
        header('Location: /admin.php');
        die();
    } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($db_admin) . '</p>';
    }
}