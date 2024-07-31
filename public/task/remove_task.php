<!-- Muhammad Fahreza 10123314 (php) -->

<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // Log task_id yang diterima
    error_log("Received request to delete task with ID: $task_id");

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Hapus semua todos yang terkait dengan task_id ini
        $stmt = $conn->prepare("DELETE FROM todos WHERE task_id = ?");
        $stmt->bind_param("i", $task_id);
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }
        $stmt->close();
        error_log("Deleted todos for task ID: $task_id");

        // Hapus task itu sendiri
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $task_id);
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }
        $stmt->close();
        error_log("Deleted task ID: $task_id");

        // Commit transaksi
        $conn->commit();
        error_log("Transaction committed successfully for task ID: $task_id");

        echo json_encode(['status' => 'success', 'message' => "Deleted task with ID $task_id successfully."]);
    } catch (Exception $e) {
        // Rollback transaksi jika ada error
        $conn->rollback();
        error_log("Transaction rollback for task ID: $task_id, Error: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit();
} else {
    error_log("Invalid request. Missing task_id");
    echo json_encode(['status' => 'error', 'message' => "Invalid request. Missing task_id"]);
}
?>