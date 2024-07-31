<!-- Muhammad Fahreza 10123314 (php) -->
<?php
session_start();
require '../../config/config.php';
require_once '../../lib/auth.php';
require_login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $project_name = $_POST['name'];
    $project_description = $_POST['description'];
    $bullet_color = $_POST['bullet_color'];

    $sql = "UPDATE projects SET name = ?, description = ?, bullet_color = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $project_name, $project_description, $bullet_color, $project_id);

    if ($stmt->execute()) {
        header("Location: view_project.php?id=$project_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>