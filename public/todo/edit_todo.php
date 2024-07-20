<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $todo_id = $_POST['todo_id'];
    $name = $_POST['name'];
    $deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : NULL;
    $priority = $_POST['priority'];
    $progress = $_POST['progress'];

    $stmt = $conn->prepare("UPDATE todos SET name = ?, deadline = ?, priority = ?, progress = ? WHERE id = ?");
    $stmt->bind_param("sssii", $name, $deadline, $priority, $progress, $todo_id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}
?>