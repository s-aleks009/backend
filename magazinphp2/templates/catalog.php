<h2>
    Каталог
</h2>

<? foreach ($catalog as $item): ?>
<div>
    <h2><a href="/product/item/<?=$item['id']?>"><?=$item['name']?></a></h2>
    <img width="300px" src="/img/<?=$item['link']?>">
    <p><?=$item['price']?></p>
    <button data-id="<?= $item['id'] ?>" class="buy">Купить</button>
</div>
<? endforeach;?>

<script>
    let buttons = document.querySelectorAll('.buy');

    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/cart/AddToCart/', {
                        method: 'POST',
                        headers: new Headers({
                            'Content-Type': 'application/json'
                        }),
                        body: JSON.stringify({
                            id: id,
                        })
                    });

                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                }
            )();
        })
    });
</script>