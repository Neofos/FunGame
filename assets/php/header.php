<header>
    <div class="header-logo">
        <div class="header-text">
            <a href=".">
                <p>FUN</p>
                <p>GAME</p>
            </a>
        </div>
    </div>
    <nav>
        <ul class="nav-left">
            <li><a href="catalogue.php">Каталог</a></li>
            <li><a href="shipping.php">Доставка</a></li>
            <li><a href="about.php">О нас</a></li>
        </ul>
        <ul class="nav-right">
            <?php
            if (isset($_COOKIE["PHPSESSID"])) :
            ?>
                <li><a href="admin.php" class="iconed-link"><span class="login"></span>AdminChad</a></li>
            <?php else : ?>
                <li><a href="login.php" class="iconed-link"><span class="login"></span>AdminChad</a></li>
            <?php endif; ?>
            <li>
                <a href="cart.php" class="iconed-link"><span class="cart"></span>Корзина
                    <?php
                    if (isset($_COOKIE['cart_prd'])) :
                        $cartProdsCount = count($_COOKIE['cart_prd']);
                    ?>
                        <span class="cart-round-thing"><?= $cartProdsCount ?></span>
                    <?php endif ?>
                </a>
            </li>
        </ul>
    </nav>
</header>