<?php
session_start(); 
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($password)) {
        $query = "SELECT id, password_hash FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id']; 
            $hashedPassword = $row['password_hash'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $userId; 
                echo "<script>alert('Вы успешно вошли в систему!'); 
                window.location.href='../todo_list.php';</script>";
            } else {
                echo "<script>alert('Неверный логин или пароль.'); 
                window.location.href='../login.php';</script>";
            }
        } else {
            echo "<script>alert('Неверный логин или пароль.'); 
            window.location.href='../login.php';</script>";
        }
    } else {
        echo "<script>alert('Пожалуйста, заполните все поля.'); 
        window.location.href='../login.php';</script>";
    }
}
?>
