<h2>Мои заказы</h2><hr>
<? foreach ($ordersUser as $item): ?>
    <div id="<?= $item['id'] ?>">
        <h3>Заказ №<?=$item['id']?></h3>
        <p>Товар: <?=$item['name']?></p>
        <p>Цена: <?=$item['price']?></p>
        <p>Статус заказа: <?=$item['status']?></p>
        <hr>
    </div>
<? endforeach; ?>
