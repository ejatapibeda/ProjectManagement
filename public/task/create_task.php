<!-- Muhammad Fahreza 10123314 (php) -->

<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO tasks (project_id, name, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $project_id, $name, $description);
    if ($stmt->execute()) {
        $task_id = $stmt->insert_id;
        echo json_encode(['status' => 'success', 'task_id' => $task_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();
    exit();
}
?>