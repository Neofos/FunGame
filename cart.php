<?php require('assets/php/db.php'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Fun Game - Корзина</title>

    <meta name="viewport" content="width=1366">

    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" href="/assets/images/site-icon.png">
</head>

<body class="body-cart">
    <?php require("assets/php/header.php") ?>
    <main>
        <div class="cart-container">
            <?php
            if (isset($_COOKIE["cart_prd"])) :
            ?>
                <h1 align="center">Корзина</h1>
                <table class="cart-products-table">
                    <tr>
                        <th class="table-numb">№</th>
                        <th сlass="table-title">Название товара</th>
                        <th сlass="table-amount" width="170">Количество товара</th>
                        <th сlass="table-cost" width="130">Стоимость</th>
                        <th class="table-delete" width="100">Удаление</th>
                    </tr>
                    <?php
                    $counter = 1;
                    foreach ($_COOKIE['cart_prd'] as $name => $value) :
                        $prodsElem = explode('KEKL', $value);
                        $qry = $fungame_db->query('SELECT * FROM products WHERE products.ID = ' . $name);
                        while ($row = $qry->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                            <tr class="product-all-info">
                                <td class="table-numb"><?= $counter++ ?></td>
                                <td height="50" style="position: relative; padding: 20px 100px;" сlass="table-title"><img style="position:absolute; left: 10px; top: calc(50% - 37px);" width="50" height="75" src="/assets/images/<?= $row['IMGPreview'] ?>">
                                    <span><?= $row['Title'] ?></span>
                                </td>
                                <td style="position: relative;" сlass="table-amount">
                                    <button style="position: relative; bottom: 4px; right: 10px; border: none; cursor: pointer; background-color: rgb(59, 79, 252); color: white;" class="minus-amount">−</button>
                                    <span class="prodsAmount"><?= $prodsElem[1] ?></span>
                                    <button style="position: relative; bottom: 4px; left: 10px; border: none; cursor: pointer; background-color: rgb(59, 79, 252); color: white;" class="plus-amount">+</button>
                                </td>
                                <td сlass="table-cost"><output class="prdTotalCost"><?= $prodsElem[0] ?></output> ₽</td>
                                <td class="table-delete"><a href="/assets/php/cart-deleter.php?id=<?= $name ?>">&#128465;</a></td>
                                <td hidden class="start-price"><?= $prodsElem[0] ?></td>
                            </tr>
                    <?php
                        endwhile;
                    endforeach;
                    ?>
                </table>
                <div class="total-fields">
                    <h2>ИТОГО:</h2>
                    <output id="total-cost-of-all-yeah"></output>
                    <button id="popup-butt">Сделать заказ</button>
                </div>
            <?php
            else :
            ?>
                <h1 align="center">Корзина пуста :(</h1>
            <?php endif; ?>
        </div>
        <div class="cart-popup cart-popup-hidden" id="cartPopa">
            <p>Укажите свои данные!</p>
            <button class="popup-x" id="popup-x-butt"><img src="/assets/images/popup-x.png"></button>
            <form action="/assets/php/send-mail.php", method="POST">
                <fieldset>
                    <input type="text" name="name" placeholder="Ваше имя" class="cart-name" pattern="\S+.*" required>
                    <input type="text" name="email" placeholder="Ваш e-mail" class="cart-email" pattern="^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(?:\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$" required>
                    <input type="submit" value="Заказать" class="zakaz-submit">
                    <input type="text" hidden name="totalZakazCost" id="totalZakazCost" value="">
                </fieldset>
            </form>
        </div>
    </main>
    <?php require("assets/php/footer.php") ?>

    <script>
        let allProds = document.querySelectorAll('.product-all-info');
        let totalCostYEAH = document.getElementById('total-cost-of-all-yeah');
        let allCosts = document.querySelectorAll('.prdTotalCost');
        let totalZakaz = document.getElementById('totalZakazCost');

        function refreshTotalCost() {
            let ttcst = 0;

            for (let i = 0; i < allCosts.length; i++) {
                ttcst += Number(allCosts[i].textContent);
            }

            totalCostYEAH.textContent = ttcst;

            totalZakaz.value = totalCostYEAH.textContent;
        }

        allProds.forEach(prod => {
            let minButt = prod.querySelector('.minus-amount');
            let prodAmount = prod.querySelector('.prodsAmount');
            let plsButt = prod.querySelector('.plus-amount');
            let totalCost = prod.querySelector('.prdTotalCost');
            let startPrice = prod.querySelector('.start-price');

            refreshCost();

            minButt.addEventListener('click', function() {
                if (Number(prodAmount.textContent) > 1)
                    prodAmount.textContent = Number(prodAmount.textContent) - 1;

                refreshCost();
                refreshTotalCost();
            });

            plsButt.addEventListener('click', function() {
                if (Number(prodAmount.textContent) < 99)
                    prodAmount.textContent = Number(prodAmount.textContent) + 1;

                refreshCost();
                refreshTotalCost();
            });

            function refreshCost() {
                totalCost.textContent = Number(startPrice.textContent) * Number(prodAmount.textContent);
            }
        });

        refreshTotalCost();

        let zakazButt = document.getElementById('popup-butt');
        let popup = document.getElementById('cartPopa');

        zakazButt.addEventListener('click', function() {
            if (popup.classList.contains('cart-popup-hidden')) {
                popup.classList.remove('cart-popup-hidden');
            }

            totalZakaz.value = totalCostYEAH.textContent;
        });

        let x = document.getElementById('popup-x-butt');

        x.addEventListener('click', function() {
            popup.classList.add('cart-popup-hidden');
        });
    </script>
</body>