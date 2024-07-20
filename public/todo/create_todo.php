<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $name = $_POST['name'];
    $deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : NULL;
    $priority = $_POST['priority'];
    $progress = $_POST['progress'];

    $stmt = $conn->prepare("INSERT INTO todos (task_id, name, deadline, priority, progress) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $task_id, $name, $deadline, $priority, $progress);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>