<!-- Muhammad Fahreza 10123314 (php) -->

<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../main/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $bullet_color = $_POST['bullet_color'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO projects (name, description, user_id, bullet_color) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $description, $user_id, $bullet_color);

    $response = array();
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to create project: " . $stmt->error;
    }

    echo json_encode($response);
    exit();
}
?>