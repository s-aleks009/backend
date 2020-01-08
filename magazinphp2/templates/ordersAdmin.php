<? if ($isAdmin): ?>
    <h2>Админка</h2>
    <a href="/orders/complete/">Выполненные</a>
    <hr>
    <? foreach ($getOrders as $item): ?>
        <div id="<?= $item['id'] ?>">
            <h3>Заказ №<?= $item['id'] ?></h3>
            <h3>Покупатель <?= $item['name'] ?></h3>
            <h3>Почта <?= $item['email'] ?></h3>
            <a href="/orders/info/<?= $item['id'] ?>">Подробнее</a>
            <p>Статус заказа
                <select data-id="<?= $item['id'] ?>" class="status">
                    <option value="0">Принят</option>
                    <option value="1">В работе</option>
                    <option value="2">Выполнен</option>
                </select>
            </p>
            <hr>
        </div>
    <? endforeach; ?>
<? else: ?>
    <p>Доступ только для админа</p>
<? endif; ?>
<script>
    let item = document.querySelectorAll('.status');

    item.forEach((elem) => {
        elem.addEventListener('change', () => {
            let selectedIndex = elem.options.selectedIndex;
            let value = elem.options[selectedIndex].value;
            let id = elem.dataset.id;
            (
                async () => {
                    const response = await fetch('/orders/setStatus/', {
                        method: 'POST',
                        headers: new Headers({
                            'Content-Type': 'application/json'
                        }),
                        body: JSON.stringify({
                            id: id,
                            status: value,
                        })
                    });
                    const answer = await response.json();
                    console.log(answer);
                }
            )();
        });
    });
</script>

<script>
    let itemStatus = document.querySelectorAll('.status');

    itemStatus.forEach((elem) => {
        let id = elem.dataset.id;
        (
            async () => {
                const response = await fetch('/orders/getStatus/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        id: id,
                    })
                });
                const answer = await response.json();
                elem.options[answer.status].selected = true;
            }
        )();
    })
</script>