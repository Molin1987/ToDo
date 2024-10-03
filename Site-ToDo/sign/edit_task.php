<?php
session_start();
include '../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $taskId = $_POST['id'];
    $newTitle = $_POST['title'];
    $newText = $_POST['text'];

    if (!empty($newTitle) && !empty($newText)) {
        $checkQuery = "SELECT is_completed FROM tasks WHERE id = '$taskId' AND user_id = '$userId'";
        $checkResult = mysqli_query($conn, $checkQuery);
        $task = mysqli_fetch_assoc($checkResult);

        if ($task['is_completed'] == 1) {
            echo json_encode(['status' => 'error', 'message' => 'Завершённые задачи не могут быть отредактированы.']);
        } else {
            $sql = "UPDATE tasks SET title = '$newTitle', description = '$newText' WHERE id = '$taskId' AND user_id = '$userId'";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(['status' => 'success', 'message' => 'Задача обновлена успешно']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ошибка при обновлении задачи']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Заголовок и текст задачи не могут быть пустыми']);
    }
}
?>
