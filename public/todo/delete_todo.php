<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

$todo_id = $_GET['id'];
$task_id = $_GET['task_id'];

$stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
$stmt->bind_param("i", $todo_id);
if ($stmt->execute()) {
    header('Location: ../task/view_task.php?task_id=' . $task_id);
    exit();
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
?>