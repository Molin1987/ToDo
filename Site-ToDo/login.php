<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="styles/style1.css">
</head>
<body>

<div class="auth-container">
    <div class="auth-box">
        <h2>Вход</h2>
        <form action="sign/login.php" method="POST">
            <input type="text" name="username" placeholder="Введите логин" required>
            <input type="password" name="password" placeholder="Введите пароль" required>
            <button type="submit">Войти</button>
        </form>
        <div class="link">
            <a href="/">Нет аккаунта? Зарегистрироваться</a>
        </div>
    </div>
</div>

</body>
</html>
