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
$stmt = $conn->prepare("SELECT email FROM invites WHERE id = ?");
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}
$stmt->bind_param("i", $invite_id);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if ($email != $_SESSION['email']) {
    echo "You are not authorized to decline this invite.";
    exit();
}

// Hapus undangan
$stmt = $conn->prepare("DELETE FROM invites WHERE id = ?");
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}
$stmt->bind_param("i", $invite_id);
$stmt->execute();
$stmt->close();

header("Location: ../main/index.php");
exit();
?>