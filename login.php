<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Fun Game - Вход</title>

    <meta name="viewport" content="width=1366">

    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" href="/assets/images/site-icon.png">
</head>

<body class="login-window">
    <?php require("assets/php/header.php") ?>
    <main>
        <div class="login-form-container">
            <form action="/assets/php/admin/authorization.php" method="POST" class="login-form">
                <fieldset>
                    <legend>Авторизация</legend>
                    <input type="text" name="username" placeholder="Имя пользователя" class="login-username" pattern="\S+.*" required>
                    <input type="password" name="password" placeholder="Пароль" class="login-password" pattern="\S+.*" required>
                    <input type="submit" value="Войти" class="login-submit">
                </fieldset>
            </form>
        </div>
    </main>
    <?php require("assets/php/footer.php") ?>
</body>