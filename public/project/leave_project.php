<!-- Muhammad Fahreza 10123314 (php) -->

<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if (!isset($_GET['project_id'])) {
    echo "Project ID is missing.";
    exit();
}

$project_id = $_GET['project_id'];
$user_id = $_SESSION['user_id'];

// Periksa apakah pengguna adalah pemilik proyek
$stmt = $conn->prepare("SELECT user_id FROM projects WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($owner_id);
$stmt->fetch();

if ($owner_id == $user_id) {
    echo "You are the owner of the project and cannot leave.";
    exit();
}
$stmt->close();

// Hapus pengguna dari project_members
$stmt = $conn->prepare("DELETE FROM project_members WHERE project_id = ? AND user_id = ?");
$stmt->bind_param("ii", $project_id, $user_id);
if ($stmt->execute()) {
    // Berhasil keluar dari proyek
    header('Location: ../main/index.php');
    exit();
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>