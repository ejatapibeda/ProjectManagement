<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if (!isset($_GET['id']) || !isset($_GET['task_id'])) {
    echo "Invalid request.";
    exit();
}

$todo_id = $_GET['id'];
$task_id = $_GET['task_id'];


$stmt = $conn->prepare("SELECT completed FROM todos WHERE id = ?");
$stmt->bind_param("i", $todo_id);
$stmt->execute();
$stmt->bind_result($completed);
$stmt->fetch();
$stmt->close();

$new_status = $completed ? 0 : 1;
$new_progress = $new_status ? 100 : 0;

$stmt = $conn->prepare("UPDATE todos SET completed = ?, progress = ? WHERE id = ?");
$stmt->bind_param("iii", $new_status, $new_progress, $todo_id);

if ($stmt->execute()) {
    header('Location: ../task/view_task.php?task_id=' . $task_id);
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>