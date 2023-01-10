<?php
session_start();

if (!isset($_SESSION['adminLogged'])) {
    header("Location: /login.php");
    die();
}

require("assets/php/db.php");
$products = $fungame_db->query('SELECT * FROM products');
$discounts = $fungame_db->query('SELECT *, discounts.ID as dcID, products.ID as pdID FROM discounts, products WHERE discounts.Product = products.ID');
$rich_games = $fungame_db->query('SELECT products.Price as pdPrice, products.ID AS pdID, products.Title AS Title FROM products WHERE ID NOT IN(SELECT discounts.Product FROM discounts)'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Fun Game - Админка</title>

    <meta name="viewport" content="width=1366">

    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" href="/assets/images/site-icon.png">
</head>

<body class="cool-admin">
    <?php require("assets/php/header.php") ?>
    <main>
        <fieldset class="table-chooser">
            <legend>Выбор Таблицы</legend>
            <label><input type="radio" id="prods" name="table-to-edit" onchange="changeTable()" checked>Продукты</label>
            <label><input type="radio" id="discs" name="table-to-edit" onchange="changeTable()">Скидки</label>
        </fieldset>
        <div id="prods-editor" class="div-editor">
            <form id="prods-form" action="assets/php/admin/products/create-product.php" class="form-editor" method="post" enctype="multipart/form-data">
                <fieldset class="editor-main-window">
                    <legend>Редактор продуктов</legend>
                    <fieldset class="window-editor">
                        <legend>Записи</legend>
                        <table class="table-editor">
                            <tbody>
                                <tr class="table-headers">
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th colspan="2">Действия</th>
                                </tr>
                                <?php while ($product = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr class="prod-bbb">
                                        <td class="td-id"><?= $product['ID'] ?></td>
                                        <td class="td-title"><?= $product['Title'] ?></td>
                                        <td class="td-update"> <a style="cursor: pointer;" class="update">✎</a> </td>
                                        <td class="td-delete"> <a href="assets/php/admin/products/delete-product.php?id=<?= $product['ID'] ?>" class="delete">✖</a> </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <fieldset class="fieldset-editor">
                        <legend>Параметры</legend>
                        <div class="fieldset-editor-imgs">
                            <label>Превью<input type="file" name="img-preview" required></label>
                            <label>Баннер<input type="file" name="img-banner" required></label>
                        </div>
                        <input id="prod-title-ed" type="text" name="title" placeholder="Название" maxlength="30" required>
                        <label align="center">Платформа<select name="platform" required>
                                <option hidden></option>
                                <option value="Steam">Steam</option>
                                <option value="Epic Games Store">Epic Games Store</option>
                                <option value="Xbox">Xbox</option>
                                <option value="PlayStation">PlayStation</option>
                                <option value="Nintendo Switch">Nintendo Switch</option>
                            </select></label>
                        <label align="center">Возрастной Рейтинг<select name="age-rating" required>
                                <option hidden></option>
                                <option value="0+">0+</option>
                                <option value="6+">6+</option>
                                <option value="13+">13+</option>
                                <option value="16+">16+</option>
                                <option value="17+">17+</option>
                                <option value="18+">18+</option>
                            </select></label>
                        <label align="center">Хит? (1 - да, 0 - нет)<select name="is-hit" required>
                                <option hidden></option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select></label>
                        <input type="number" name="price" placeholder="Цена" min="1" max="9999" required>
                        <textarea name="description" id="" cols="30" rows="10" placeholder="Описание" required></textarea>
                        <input type="submit" value="Создать" id="prod-submit-butt">
                        <input id="reset-prod-butt" type="reset" value="Сброс">
                        <a href="assets/php/admin/exit.php" class="exit-link">Выход</a>
                    </fieldset>
                </fieldset>
            </form>
        </div>
        <div id="discs-editor" class="div-editor editor-hidden">
            <form id="discs-form" action="assets/php/admin/discounts/create-discount.php" class="form-editor" method="post" enctype="multipart/form-data">
                <fieldset class="editor-main-window">
                    <legend>Редактор скидок</legend>
                    <fieldset class="window-editor">
                        <legend>Записи</legend>
                        <table class="table-editor">
                            <tbody>
                                <tr class="table-headers">
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th colspan="2">Действия</th>
                                </tr>
                                <?php while ($discount = $discounts->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr class="disc-bbb">
                                        <td class="td-id"><?= $discount['dcID'] ?></td>
                                        <td class="td-title"><?= $discount['Title'] ?></td>
                                        <td hidden class="gamele-idele"><?= $discount['Product'] ?></td>
                                        <td class="td-update"> <a style="cursor: pointer;" class="update">✎</a> </td>
                                        <td class="td-delete"> <a href="assets/php/admin/discounts/delete-discount.php?id=<?= $discount['dcID'] ?>" class="delete">✖</a> </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <fieldset class="fieldset-editor">
                        <legend>Параметры</legend>
                        <label align="center" style="margin-bottom: 10px;" id="gameIdLabelHidden" hidden>Игра с ID:<input id="gameIdHidden" type="text" name="game-id-hidden" readonly hidden></label>
                        <input id="gameTitleHidden" type="text" readonly hidden>
                        <select id="discs-title-ed" name="game-id" required>
                            <?php while ($rich_game = $rich_games->fetch(PDO::FETCH_ASSOC)) : ?>
                                <option value="<?= $rich_game['pdID'] ?>"><?= $rich_game['Title'] ?><br>
                                    <span>(<?= $rich_game['pdPrice'] ?> ₽)</span>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <input type="number" name="percent" placeholder="Процент" min="1" max="100" required>
                        <input type="text" name="new-price" placeholder="Новая цена" maxlength="4" required>
                        <input id="disc-submit-butt" type="submit" value="Создать">
                        <input id="reset-disc-butt" type="reset" value="Сброс">
                        <a href="assets/php/admin/exit.php" class="exit-link">Выход</a>
                    </fieldset>
                </fieldset>
            </form>
        </div>
    </main>
    <?php require("assets/php/footer.php") ?>

    <script>
        let prodsRadio = document.getElementById('prods');
        let discsRadio = document.getElementById('discs');

        let prodsEditor = document.getElementById('prods-editor');
        let discsEditor = document.getElementById('discs-editor');

        prodsRadio.checked = true;

        function changeTable() {
            if (prodsRadio.checked) {
                prodsEditor.classList.remove('editor-hidden');
                discsEditor.classList.add('editor-hidden');
            } else {
                discsEditor.classList.remove('editor-hidden');
                prodsEditor.classList.add('editor-hidden');
            }
        }

        // JopnoStart

        let allProdRows = prodsEditor.querySelectorAll('.prod-bbb');
        let prodSubmitButt = document.getElementById('prod-submit-butt');
        let prodsForm = document.getElementById('prods-form');
        let prodTitleEd = document.getElementById('prod-title-ed');
        let prodResetButt = document.getElementById('reset-prod-butt');

        let allProdInputs = prodsEditor.querySelectorAll('input');
        let allProdSelects = prodsEditor.querySelectorAll('select');
        let prodTextbox = prodsEditor.querySelector('textarea');

        prodResetButt.addEventListener('click', function() {
            prodsForm.action = "assets/php/admin/products/create_product.php";
            prodSubmitButt.value = "Создать";

            allProdInputs.forEach(inp => {
                inp.required = true;
            });

            allProdSelects.forEach(inp => {
                inp.required = true;
            });

            prodTextbox.required = true;
        });

        allProdRows.forEach(row => {
            let prodsUpdator = row.querySelector('.update');
            let prodId = row.querySelector('.td-id');
            let prodTitle = row.querySelector('.td-title');

            prodsUpdator.addEventListener('click', function() {
                prodSubmitButt.value = "Обновить";
                prodsForm.action = "assets/php/admin/products/update_product.php?id=" + prodId.textContent;
                prodTitleEd.value = prodTitle.textContent;

                allProdInputs.forEach(inp => {
                    inp.required = false;
                });

                allProdSelects.forEach(inp => {
                    inp.required = false;
                });

                prodTextbox.required = false;
            });
        });

        let allDiscsRows = discsEditor.querySelectorAll('.disc-bbb');
        let discSubmitButt = document.getElementById('disc-submit-butt');
        let discsForm = document.getElementById('discs-form');
        let gameIdHidden = document.getElementById('gameIdHidden');
        let gameTitleHidden = document.getElementById('gameTitleHidden');
        let gameIdLabelHidden = document.getElementById('gameIdLabelHidden');
        let discGameTitleEd = document.getElementById('discs-title-ed');
        let discResetButt = document.getElementById('reset-disc-butt');

        let allDiscInputs = discsEditor.querySelectorAll('input');

        discResetButt.addEventListener('click', function() {
            discsForm.action = "assets/php/admin/discounts/create_discount.php";
            discSubmitButt.value = "Создать";
            gameIdHidden.hidden = true;
            discGameTitleEd.hidden = false;
            gameIdLabelHidden.hidden = true;
            gameTitleHidden.hidden = true;
            allDiscInputs.forEach(inp => {
                inp.required = true;
            });
        });

        allDiscsRows.forEach(row => {
            let discsUpdator = row.querySelector('.update');
            let discId = row.querySelector('.td-id');
            let discGameId = row.querySelector('.gamele-idele');
            let discGameTitle = row.querySelector('.td-title');

            discsUpdator.addEventListener('click', function() {
                discSubmitButt.value = "Обновить";
                discsForm.action = "assets/php/admin/discounts/update_discount.php?id=" + discId.textContent;
                gameIdHidden.value = discGameId.textContent;
                gameTitleHidden.value = discGameTitle.textContent;
                gameIdHidden.hidden = false;
                discGameTitleEd.hidden = true;
                gameIdLabelHidden.hidden = false;
                gameTitleHidden.hidden = false;
                allDiscInputs.forEach(inp => {
                    inp.required = false;
                });
            });
        });

        // JopnoEnd
    </script>
</body>