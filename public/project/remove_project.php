<!-- Muhammad Fahreza 10123314 (php) -->
<!-- Puke Begawan Hidayat 10123335 (html) -->
<!-- Farel Mochamad Gibransyah 10123304 (html) -->

<?php
session_start();
require '../../config/config.php';
require_once '../../lib/auth.php';

require_login();

if (!isset($_POST['project_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Project ID is missing.']);
    exit();
}

$project_id = $_POST['project_id'];

// Start transaction
$conn->begin_transaction();

try {
    // Delete all todos related to project_id
    $stmt = $conn->prepare("DELETE todos FROM todos INNER JOIN tasks ON todos.task_id = tasks.id WHERE tasks.project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->close();

    // Delete all tasks related to project_id
    $stmt = $conn->prepare("DELETE FROM tasks WHERE project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->close();

    // Delete all invites related to project_id
    $stmt = $conn->prepare("DELETE FROM invites WHERE project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->close();

    // Delete all project members related to project_id
    $stmt = $conn->prepare("DELETE FROM project_members WHERE project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->close();

    // Delete the project itself
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->close();

    // Commit transaction
    $conn->commit();

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    // Rollback transaction if there is an error
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Error deleting project: ' . $e->getMessage()]);
}
$conn->close();
?>