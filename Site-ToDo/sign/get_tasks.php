<?php
session_start();
include '../database/connect.php';

$userId = $_SESSION['user_id'];

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, trim($_GET['search'])) : '';
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : 'all';

$sql = "SELECT id, title, description, is_completed FROM tasks WHERE user_id = '$userId'";

if ($search !== '') {
    $sql .= " AND title LIKE '%$search%'";
}

if ($filter === 'completed') {
    $sql .= " AND is_completed = 1";
} elseif ($filter === 'incomplete') {
    $sql .= " AND is_completed = 0";
}

$result = mysqli_query($conn, $sql);

$tasks = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'text' => $row['description'],
            'completed' => (bool) $row['is_completed']
        ];
    }
}

echo json_encode($tasks);
?>
