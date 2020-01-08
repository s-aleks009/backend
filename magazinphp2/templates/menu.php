<a href="/">Главная</a>
<a href="/product/catalog/">Каталог</a>
<?if($isAdmin):?>
    <a href="/cart/">Корзина (<span id="count"><?=$count?></span>)</a>
    <a href="/orders/get/">Админка</a>
<?else:?>
    <a href="/cart/">Корзина (<span id="count"><?=$count?></span>)</a>
    <a href="/orders/">Мои заказы</a>
<?endif;?>
<br>
