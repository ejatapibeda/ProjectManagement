<!-- Muhammad Fahreza 10123314 (php) -->

<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if (!isset($_GET['id'])) {
    echo "Invite ID is missing.";
    exit();
}

$invite_id = $_GET['id'];

// Ambil detail undangan
$stmt = $conn->prepare("SELECT project_id FROM invites WHERE id = ?");
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}
$stmt->bind_param("i", $invite_id);
$stmt->execute();
$stmt->bind_result($project_id);
$stmt->fetch();
$stmt->close();

// Pastikan proyek yang diundang ada dan belum dimiliki oleh pengguna yang menerima undangan
$stmt_check = $conn->prepare("SELECT id FROM projects WHERE id = ? AND user_id = ?");
$stmt_check->bind_param("ii", $project_id, $_SESSION['user_id']);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo "You are already a member of this project.";
    exit();
}
$stmt_check->close();

// Tambahkan hubungan antara proyek dan pengguna yang menerima undangan
$stmt_insert = $conn->prepare("INSERT INTO project_members (project_id, user_id) VALUES (?, ?)");
$stmt_insert->bind_param("ii", $project_id, $_SESSION['user_id']);
if ($stmt_insert->execute()) {
    // Hapus undangan setelah berhasil menerima undangan
    $stmt_delete = $conn->prepare("DELETE FROM invites WHERE id = ?");
    $stmt_delete->bind_param("i", $invite_id);
    if ($stmt_delete->execute()) {
        header("Location: ../main/index.php");
    } else {
        die('Failed to delete invite: ' . $stmt_delete->error);
    }
} else {
    die('Failed to accept invitation: ' . $stmt_insert->error);
}

$conn->close();
?>