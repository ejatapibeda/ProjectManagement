<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE tasks SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $description, $task_id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();
    exit();
}
?>