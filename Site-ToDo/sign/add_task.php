<?php
session_start();
include '../database/connect.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Пользователь не авторизован']);
        exit();
    }

    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $note = $_POST['note'];

    $sql = "INSERT INTO tasks (user_id, title, description) VALUES ('$userId', '$title', '$note')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Задача добавлена успешно!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка при добавлении задачи.']);
    }

    exit();
}
?>
