<footer>
    <div class="footer-container">
        <div class="link-container">
            <ul>
                <li><a href="catalogue.php">Каталог</a></li>
                <li><a href="shipping.php">Доставка</a></li>
                <li><a href="about.php">О нас</a></li>
            </ul>
            <ul>
                <?php
                if (isset($_COOKIE["PHPSESSID"])) :
                ?>
                    <li><a href="admin.php">Админка</a></li>
                <?php else : ?>
                    <li><a href="login.php">Вход</a></li>
                <?php endif; ?>
                <li><a href="cart.php">Корзина</a></li>
            </ul>
        </div>
        <div class="contacts">
            <p><a href="tel:+78005553535">+7 (800) 555-35-35</a></p>
            <p>г. Краснодар, ул. Сормовская 800</p>
        </div>
        <div class="right-side">
            <div class="media-container">
                <p>Мы в соцсетях:</p>
                <ul class="media-list">
                    <li><a href="https://facebook.com"><img src="/assets/images/facebook-icon.png" class="fb-icon" alt="Иконка Фейсбука"></a></li>
                    <li><a href="https://vk.com"><img src="/assets/images/vk_icon.png" class="vk-icon" alt="Иконка ВКонтакте"></a></li>
                    <li><a href="https://telegram.org"><img src="/assets/images/telega-icon.png" class="tg-icon" alt="Иконка Телеграма"></a></li>
                    <li><a href="https://youtube.com"><img src="/assets/images/youtube_icon.png" class="yt-icon" alt="Иконка Ютуба"></a></li>
                </ul>
            </div>
            <p class="footer-disclaimer">Все названия продуктов и игр, компаний и марок, логотипы,
                товарные знаки и другие материалы являются собственностью соответствующих владельцев</p>
        </div>
    </div>
</footer>