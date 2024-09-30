<?php
session_start();
include '../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];  
    $taskId = $_POST['id'];          

    $sql = "DELETE FROM tasks WHERE id = '$taskId' AND user_id = '$userId'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Задача удалена успешно']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка при удалении задачи']);
    }
}
?>
