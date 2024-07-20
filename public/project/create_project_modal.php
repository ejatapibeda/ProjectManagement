<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_project'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $bullet_color = $_POST['bullet_color'];
    $user_id = $_SESSION['user_id'];

    // Check if project with the same name already exists for the user
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM projects WHERE name = ? AND user_id = ?");
    $stmt_check->bind_param("si", $name, $user_id);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        $_SESSION['error_message'] = "Project with this name already exists.";
    } else {
        // Insert the project into the database
        $stmt_insert = $conn->prepare("INSERT INTO projects (name, description, user_id, bullet_color) VALUES (?, ?, ?, ?)");
        $stmt_insert->bind_param("ssis", $name, $description, $user_id, $bullet_color);

        if ($stmt_insert->execute()) {
            $_SESSION['success_message'] = "Project created successfully";
        } else {
            $_SESSION['error_message'] = "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Create Project</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createProjectForm" method="post" action="../project/create_project_modal.php"
                    style="border-radius:10px;">
                    <div class="form-group">
                        <label for="name">Project Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bullet_color">Bullet Color:</label>
                        <input type="color" class="form-control" id="bullet_color" name="bullet_color" value="#000000">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createProjectForm" name="create_project">Create
                    Project</button>
            </div>
        </div>
    </div>
</div>