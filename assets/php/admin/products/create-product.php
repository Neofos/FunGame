<?php
require($_SERVER['DOCUMENT_ROOT'] . "/assets/php/admin/admin-db.php");

if (
    is_uploaded_file($_FILES["img-preview"]['tmp_name']) && is_uploaded_file($_FILES["img-banner"]['tmp_name']) &&
    isset($_POST["title"]) && isset($_POST["platform"]) &&
    isset($_POST["age-rating"]) && isset($_POST["is-hit"]) &&
    isset($_POST["price"]) && isset($_POST["description"])
) {
    $title = $db_admin->real_escape_string($_POST["title"]);
    $platform = $db_admin->real_escape_string($_POST["platform"]);
    $rating = $db_admin->real_escape_string($_POST["age-rating"]);
    $hit = $db_admin->real_escape_string($_POST["is-hit"]);
    $price = $db_admin->real_escape_string($_POST["price"]);
    $description = $db_admin->real_escape_string($_POST["description"]);

    $preview_img = $_FILES['img-preview'];
    $preview_name = $preview_img['name'];

    move_uploaded_file($preview_img['tmp_name'], "../../../images/".$preview_name);

    $banner_img = $_FILES['img-banner'];
    $banner_name = $banner_img['name'];

    move_uploaded_file($banner_img['tmp_name'], "../../../images/".$banner_name);

    $sql = "INSERT INTO products (Title, IMGPreview, IMGBanner, Price, Description,
    Platform, AgeRating, IsHit) VALUES ('$title', '$preview_name', '$banner_name', '$price', 
    '$description', '$platform', '$rating', '$hit')";
    if ($db_admin->query($sql)) {
        header('Location: /admin.php');
        die();
    } else {
        echo "Ошибка: " . $db_admin->error;
    }
} else {
    echo "Ошибка: не все отправилось (поч)";
}
