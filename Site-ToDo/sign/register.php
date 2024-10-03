<?php
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Пользователь с таким именем уже существует.'); 
            window.location.href='../reg.php';</script>";
        } else {
            $query = "INSERT INTO users (username, password_hash) VALUES ('$username', '$passwordHash')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Регистрация успешна! Теперь вы можете войти.'); 
                window.location.href='../index.php';</script>";
            } else {
                echo "<script>alert('Произошла ошибка при регистрации.'); 
                window.location.href='../reg.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Пожалуйста, заполните все поля.'); 
        window.location.href='../reg.php';</script>";
    }
}
?>