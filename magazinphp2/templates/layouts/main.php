<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?if ($auth):?>
    Добро пожаловать <?=$username?>, <a href="/auth/logout/"> [Выход]</a><br>
<?else:?>
    <form action="/auth/login/" method="post">
        <input type="text" name="login">
        <input type="password" name="password">
        <input type="submit" name="send">
    </form>
<?endif;?>
<?=$menu?>
<?=$content?>
</body>
</html>
