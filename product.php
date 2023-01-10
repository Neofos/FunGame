<?php
require("assets/php/db.php");
$product_id = $_GET['id'];
$sql = 'SELECT * FROM products WHERE id=' . $product_id;
$stmt = $fungame_db->prepare($sql);
$result = $fungame_db->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Fun Game - <?= $row['Title'] ?></title>

    <meta name="viewport" content="width=1366">

    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" href="/assets/images/site-icon.png">
</head>

<body class="product-page">
    <?php require("assets/php/header.php") ?>
    <main>
        <div class="product-content">
            <div class="product-image">
                <img src="/assets/images/<?= $row['IMGPreview'] ?>">
            </div>
            <div class="product-info">
                <h1><?= $row['Title'] ?> (<?= $row['Platform'] ?>)</h1>
                <div class="product-price">
                    <?php
                    $prd_price;
                    $discount_products = $fungame_db->query('SELECT * FROM discounts WHERE 
                    discounts.Product =' . $row['ID']);
                    if ($discount_products->rowCount() > 0) :
                        $discount_product = $discount_products->fetch(PDO::FETCH_ASSOC)
                    ?>
                        <p class="discounted-product-price"><?= $row['Price'] ?></p>
                        <p class="discounted-product-new-price"><?= $discount_product['NewPrice'] ?></p>
                        <p class="discounted-product-percent">-<?= $discount_product['Percent'] ?>%</p>
                    <?php $prd_price = $discount_product['NewPrice'];
                    else : ?>
                        <p class="product-price"><?= $row['Price'] ?></p>
                    <?php $prd_price = $row['Price'];
                    endif; ?>
                </div>

                <form action="/assets/php/cart-adder.php" method="GET">
                    <div class="amount-field">
                        <button class="number-minus" type="button" onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange();">−</button>
                        <input type="number" name="amount" id="product-amount" value="1" min="1" max="99">
                        <button class="number-plus" type="button" onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange();">+</button>
                        <input type="text" name="id" value="<?= $row['ID'] ?>" hidden>
                        <input type="text" name="price" value="<?= $prd_price ?>" hidden>
                    </div>
                    <input type="submit" name="add-cart" value="В корзину" class="add-to-cart-button">
                </form>
                <h2 class="description-header">ОПИСАНИЕ</h2>
                <hr>
                <p class="product-desc"><?= $row['Description'] ?></p>
            </div>
        </div>
    </main>
    <?php require("assets/php/footer.php") ?>
</body>

</html>