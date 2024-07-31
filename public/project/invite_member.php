<!-- Muhammad Fahreza 10123314 -->

<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

$project_id = isset($_POST['project_id']) ? $_POST['project_id'] : (isset($_GET['project_id']) ? $_GET['project_id'] : null);

if ($project_id === null) {
    echo "Project ID is missing.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Periksa apakah email terdaftar
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Insert invite into database
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO invites (project_id, email) VALUES (?, ?)");
        $stmt->bind_param("is", $project_id, $email);
        if ($stmt->execute()) {
            echo "Invitation sent.";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Email is not registered.";
    }
    $stmt->close();
}
?>