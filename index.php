<?php require("assets/php/db.php") ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Fun Game - видеоигровой магазин</title>

    <meta name="viewport" content="width=1366">

    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" href="/assets/images/site-icon.png">

    <script defer src="/assets/js/jquery-3.6.0.min.js"></script>
    <script defer src="/assets/js/script-index.js"></script>
</head>

<body>
    <?php require("assets/php/header.php") ?>
    <main>
        <div class="main-platforms">
            <ul>
                <li><a onclick="sendFilter('Steam')" href="catalogue.php"><span><img src="/assets/images/steam-icon.svg" alt="Steam Icon"></span>Steam</a>
                    <hr>
                </li>
                <li><a onclick="sendFilter('Epic Games Store')" href="catalogue.php"><span><img src="/assets/images/egs-icon.svg" alt="EGS Icon"></span>Epic Games Store</a>
                    <hr>
                </li>
                <li><a onclick="sendFilter('Xbox')" href="catalogue.php"><span><img src="/assets/images/xbox-icon.svg" alt="Xbox Icon"></span>Xbox</a>
                    <hr>
                </li>
                <li><a onclick="sendFilter('PlayStation')" href="catalogue.php"><span><img src="/assets/images/playstation-icon.svg" alt="PlayStation Icon"></span>PlayStation</a>
                    <hr>
                </li>
                <li><a onclick="sendFilter('Nintendo Switch')" href="catalogue.php"><span><img src="/assets/images/nintendo-switch-icon.svg" alt="Nintendo Switch Icon"></span>Nintendo Switch</a></li>
            </ul>
        </div>
        <div class="main-hit-list">
            <button class="hit-button-right" onclick="changeSlideRight()"><img src="/assets/images/arrow.svg"></button>
            <button class="hit-button-left" onclick="changeSlideLeft()"><img src="/assets/images/arrow.svg"></button>
            <a class="hit-product-link">
                <div class="main-hit-label">
                    <h2>Хит продаж!</h2>
                </div>
                <ul>
                    <?php
                    $hit_products = $fungame_db->query('SELECT * FROM products WHERE IsHit=1');
                    while ($row = $hit_products->fetch(PDO::FETCH_ASSOC)) : ?>
                        <li class="slide">
                            <div class="main-hit-game-info">
                                <p><?= $row['Title'] ?></p>
                                <p><?= $row['Price'] ?> ₽</p>
                                <img src="/assets/images/<?= $row['IMGBanner'] ?>" hidden>
                                <p hidden class="hit-product-id"><?= $row['ID'] ?></p>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </a>
        </div>
        <div class="discount-container discount-container-hidden">
            <div class="discount-header">
                <h2>Успей купить!</h2>
            </div>
            <hr class="discount-line">
            <ul class="discounted-products-list">
                <?php
                $discount_products = $fungame_db->query('SELECT * FROM products, discounts WHERE discounts.Product = products.ID');
                while ($product = $discount_products->fetch(PDO::FETCH_ASSOC)) : ?>
                    <li class="discounted-game">
                        <div class="discounted-game-image">
                            <img src="/assets/images/<?= $product['IMGPreview'] ?>">
                        </div>
                        <div class="discounted-game-name">
                            <p class="discounted-game-title"><?= $product['Title'] ?></p>
                            <p class="discounted-game-platform"><?= $product['Platform'] ?></p>
                        </div>
                        <div class="discounted-game-numbers">
                            <p class="discounted-game-price"><?= $product['Price'] ?></p>
                            <p class="discounted-game-new-price"><?= $product['NewPrice'] ?></p>
                            <p class="discounted-game-percent">-<?= $product['Percent'] ?>%</p>
                        </div>
                        <a href="/product.php?id=<?= $product['Product'] ?>" class="iconed-link discount-button"><span class="cart"></span>Купить</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </main>
    <?php require("assets/php/footer.php") ?>
</body>

</html>