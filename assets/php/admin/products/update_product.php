<?php
require($_SERVER['DOCUMENT_ROOT'] . "/assets/php/admin/admin-db.php");

if (
    (is_uploaded_file($_FILES["img-preview"]['tmp_name']) || is_uploaded_file($_FILES["img-banner"]['tmp_name']) &&
        isset($_POST["title"]) || isset($_POST["platform"]) ||
        isset($_POST["age-rating"]) || isset($_POST["is-hit"]) ||
        isset($_POST["price"]) || isset($_POST["description"])) && isset($_GET["id"])
) {
    $title = $db_admin->real_escape_string($_POST["title"]);
    $platform = $db_admin->real_escape_string($_POST["platform"]);
    $rating = $db_admin->real_escape_string($_POST["age-rating"]);
    $hit = $db_admin->real_escape_string($_POST["is-hit"]);
    $price = $db_admin->real_escape_string($_POST["price"]);
    $description = $db_admin->real_escape_string($_POST["description"]);
    $id = $_GET['id'];

    $preview_img = $_FILES['img-preview'];
    $preview_name = $preview_img['name'];

    $banner_img = $_FILES['img-banner'];
    $banner_name = $banner_img['name'];

    $sql = "UPDATE products SET ";

    if ($title != '') {
        $sql .= "Title = '$title', ";
    }
    if ($platform != '') {
        $sql .= "Platform = '$platform', ";
    }
    if ($rating != '') {
        $sql .= "AgeRating = '$rating', ";
    }
    if ($hit != '') {
        $sql .= "IsHit = '$hit', ";
    }
    if ($price != '') {
        $sql .= "Price = '$price', ";
    }
    if ($description != '') {
        $sql .= "Description = '$description', ";
    }
    if ($preview_name != '') {
        $sql .= "IMGPreview = '$preview_name', ";
        move_uploaded_file($preview_img['tmp_name'], "../../../images/" . $preview_name);
    }
    if ($banner_name != '') {
        $sql .= "IMGBanner = '$banner_name', ";
        move_uploaded_file($banner_img['tmp_name'], "../../../images/" . $banner_name);
    }

    $sql = rtrim($sql, ", ");

    $sql .=  " WHERE products.ID = '$id'";

    if ($db_admin->query($sql)) {
        header('Location: /admin.php');
        die();
    } else {
        echo "Ошибка: " . $db_admin->error;
    }
} else {
    echo "Ошибка";
}