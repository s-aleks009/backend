<? if ($isAdmin): ?>
    <h2>Админка</h2>
    <hr>
    <? foreach ($infoOrders as $item): ?>
        <div id="<?= $item['id'] ?>">
            <p>Заказ №<?= $item['id'] ?></p>
            <p>Товар: <?= $item['name'] ?></p>
            <p>Цена: <?= $item['price'] ?></p>
            <hr>
        </div>
    <? endforeach; ?>
<? else: ?>
    <p>Доступ только для админа</p>
<? endif; ?>
