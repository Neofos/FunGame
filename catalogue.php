<?php
require("assets/php/db.php");
$products = $fungame_db->query('SELECT * FROM products');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Fun Game - Товары</title>

    <meta name="viewport" content="width=1366">

    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" href="/assets/images/site-icon.png">

    <script defer src="/assets/js/script-catalogue.js"></script>
</head>

<body>
    <?php require("assets/php/header.php") ?>
    <main class="catalogue-main">
        <div class="catalogue-filter-container">
            <form сlass="catalogue-filter">
                <fieldset class="catalogue-fieldset">
                    <legend>Фильтры</legend>
                    <div class="catalogue-price">
                        <fieldset>
                            <legend>Цена</legend>
                            <label>От
                                <input type="range" value="0" min="0" max="5399" id="range1" oninput="rangevalue1.value=value" />
                                <input type="number" id="rangevalue1" value="0" min="0" max="5399" oninput="range1.value=value">
                                <span> ₽</span>
                            </label><br>
                            <label>До
                                <input type="range" value="5399" min="0" max="5399" id="range2" oninput="rangevalue2.value=value" />
                                <input type="number" id="rangevalue2" value="5399" min="0" max="5399" oninput="range2.value=value">
                                <span> ₽</span>
                            </label>
                        </fieldset>
                    </div>
                    <fieldset class="platform-fieldset">
                        <legend>Платформа</legend>
                        <label>
                            <input type="checkbox" name="Steam">
                            Steam</label><br>
                        <label>
                            <input type="checkbox" name="Epic Games Store">
                            Epic Games Store</label><br>
                        <label>
                            <input type="checkbox" name="Xbox">
                            Xbox</label><br>
                        <label>
                            <input type="checkbox" name="PlayStation">
                            PlayStation</label><br>
                        <label>
                            <input type="checkbox" name="Nintendo Switch">
                            Nintendo Switch</label>
                    </fieldset>
                    <fieldset class="age-fieldset">
                        <legend>Рейтинг</legend>
                        <label>
                            <input type="checkbox" name="0+">
                            0+</label><br>
                        <label>
                            <input type="checkbox" name="6+">
                            6+</label><br>
                        <label>
                            <input type="checkbox" name="13+">
                            13+</label><br>
                        <label>
                            <input type="checkbox" name="16+">
                            16+</label><br>
                        <label>
                            <input type="checkbox" name="17+">
                            17+</label>
                        <label>
                            <input type="checkbox" name="18+">
                            18+</label>
                    </fieldset>
                </fieldset>
            </form>
        </div>
        <div class="game-container">
            <ul class="products-list">
                <?php
                while ($product = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                    <li class="game">
                        <div class="game-image">
                            <img src="/assets/images/<?= $product['IMGPreview'] ?>">
                        </div>
                        <div class="game-name">
                            <p class="game-title"><?= $product['Title'] ?></p>
                            <p class="game-platform"><?= $product['Platform'] ?></p>
                        </div>
                        <div class="game-numbers">
                            <!-- Как же жопно -->
                            <?php
                                $discount_products = $fungame_db->query('SELECT * FROM discounts WHERE discounts.Product =' . $product['ID']);
                                if ($discount_products->rowCount() > 0):
                                    $discount_product = $discount_products->fetch(PDO::FETCH_ASSOC)
                            ?>
                                <p class="discounted-game-price"><?= $product['Price'] ?></p>
                                <p class="discounted-game-new-price"><?= $discount_product['NewPrice'] ?></p>
                                <p class="discounted-game-percent">-<?= $discount_product['Percent'] ?>%</p>
                            <?php else : ?>
                                <p class="game-price"><?= $product['Price'] ?></p>
                            <?php endif; ?>
                        </div>
                        <p hidden class="game-age"><?= $product['AgeRating'] ?></p>
                        <a href="/product.php?id=<?= $product['ID'] ?>" class="iconed-link game-button"><span class="cart"></span>Купить</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </main>
    <?php require("assets/php/footer.php") ?>
</body>