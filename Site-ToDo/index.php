<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="styles/style1.css">
</head>
<body>

<div class="auth-container">
    <div class="auth-box">
        <h2>Регистрация</h2>
        <form action="sign/register.php" method="POST">
            <input type="text" name="username" placeholder="Введите логин" required>
            <input type="password" name="password" placeholder="Введите пароль" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <div class="link">
            <a href="login.php">Уже есть аккаунт? Войти</a>
        </div>
    </div>
</div>

</body>
</html>
