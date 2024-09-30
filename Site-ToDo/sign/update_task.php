<?php
session_start();
include '../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $taskId = $_POST['id'];
    $completed = $_POST['completed'] ? 1 : 0;

    $sql = "UPDATE tasks SET is_completed = '$completed' WHERE id = '$taskId' AND user_id = '$userId'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
