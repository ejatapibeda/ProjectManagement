<!-- Muhammad Fahreza 10123314 (php) -->
<!-- Puke Begawan Hidayat 10123335 (html) -->
<!-- Farel Mochamad Gibransyah 10123304 (html) -->

<?php
session_start();
require '../../config/config.php';
require_once '../../lib/auth.php';
require_login();

if (!isset($_GET['id'])) {
    echo "Project ID is missing.";
    exit();
}

$project_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch project details from the database
$sql = "SELECT name, description, bullet_color, user_id FROM projects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$stmt->bind_result($project_name, $project_description, $bullet_color, $owner_id);
$stmt->fetch();
$stmt->close();

// Fetch tasks related to the project
$tasks = [];
$sql_tasks = "SELECT id, name FROM tasks WHERE project_id = ?";
$stmt_tasks = $conn->prepare($sql_tasks);
$stmt_tasks->bind_param("i", $project_id);
$stmt_tasks->execute();
$result_tasks = $stmt_tasks->get_result();
while ($row = $result_tasks->fetch_assoc()) {
    $tasks[] = $row;
}
$stmt_tasks->close();

include '../function/dataoperation.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManagement - View Project</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <?php include '../../lib/script.php'; ?>
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
</head>

<body>
    <?php include '../sidebar.php'; ?>
    <?php include '../navbar.php'; ?>

    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">
            <section class="mb-4">
                <div class="project-header shadow">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-4 mb-3">
                                <i class="fa-solid fa-folder-open me-3"></i>
                                <?= htmlspecialchars($project_name) ?>
                            </h1>
                            <p class="lead"><?= htmlspecialchars($project_description) ?></p>
                        </div>
                        <div class="col-md-4">
                            <div class="action-buttons d-flex flex-wrap justify-content-md-end">
                                <button type="button" class="btn btn-light btn-lg" data-toggle="modal"
                                    data-target="#addTaskModal">
                                    <i class="fas fa-plus-circle me-2"></i>New Task
                                </button>
                                <button type="button" class="btn btn-outline-light btn-lg" data-toggle="modal"
                                    data-target="#editProjectModal">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </button>
                                <button type="button" class="btn btn-outline-light btn-lg" data-toggle="modal"
                                    data-target="#inviteMemberModal">
                                    <i class="fas fa-user-plus me-2"></i>Invite
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-lg" data-toggle="modal"
                                    data-target="#removeProjectModal" data-project_id="<?= $project_id ?>">
                                    <i class="fas fa-trash-alt me-2"></i>Remove
                                </button>
                                <?php if ($owner_id != $user_id): ?>
                                    <a href="leave_project.php?project_id=<?= $project_id ?>"
                                        class="btn btn-outline-warning btn-lg">
                                        <i class="fas fa-sign-out-alt me-2"></i>Leave Project
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($tasks as $task): ?>
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100 shadow-sm task-card">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-3 text-truncate">
                                        <?= htmlspecialchars($task['name']) ?>
                                    </h5>
                                    <div class="mt-auto d-flex justify-content-between">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#editTaskModal" data-task-id="<?= $task['id'] ?>"
                                            data-task-name="<?= htmlspecialchars($task['name']) ?>">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>
                                        <a href="../task/view_task.php?task_id=<?= $task['id'] ?>"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>

    <?php
    include '../task/create_task_modal.php';
    include '../task/edit_task_modal.php';
    include 'manage_invite_modal.php';
    include 'edit_project_modal.php';
    include 'remove_project_modal.php';
    include 'invite_member_modal.php';
    ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

    <script>
        $('#editTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('task-id');
            var taskName = button.data('task-name');

            var modal = $(this);
            modal.find('#edit_task_id').val(taskId);
            modal.find('#editTaskName').val(taskName);
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>