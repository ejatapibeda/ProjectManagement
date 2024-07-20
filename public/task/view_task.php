<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

if (!isset($_GET['task_id'])) {
    echo "Task ID is missing.";
    exit();
}

$task_id = $_GET['task_id'];

$stmt = $conn->prepare("SELECT name, description, project_id FROM tasks WHERE id = ?");
$stmt->bind_param("i", $task_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($task_name, $task_description, $project_id);
    $stmt->fetch();
} else {
    echo "Task not found.";
    exit();
}
$stmt->close();

// Fetch the total and completed todo counts
$stmt = $conn->prepare("SELECT 
                            COUNT(id) AS total, 
                            SUM(CASE WHEN completed = 1 THEN 1 ELSE 0 END) AS completed 
                        FROM todos 
                        WHERE task_id = ?");
$stmt->bind_param("i", $task_id);
$stmt->execute();
$result = $stmt->get_result();
$counts = $result->fetch_assoc();
$total = $counts['total'];
$completed = $counts['completed'];
$stmt->close();

include '../function/dataoperation.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManagement - View Task: <?= htmlspecialchars($task_name) ?></title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .task-header,
        .todo-list {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .btn-custom {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .task-header h1 {
                font-size: 1.5rem;
            }

            .btn-custom {
                width: 100%;
            }

            .table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <?php include '../sidebar.php'; ?>
    <?php include '../navbar.php'; ?>

    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">
            <section class="mb-4">
                <div class="card">
                    <div class="card-header py-3">
                        <h5 class="mb-0 text-center"><strong>Task Management</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="task-header">
                            <h1 class="mb-3"><?= htmlspecialchars($task_name) ?></h1>
                            <p class="lead mb-4"><?= htmlspecialchars($task_description) ?></p>
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <button class="btn btn-primary btn-custom" data-toggle="modal"
                                    data-target="#createTodoModal">
                                    <i class="fas fa-plus-circle me-2"></i>Add To-Do
                                </button>
                                <button type="button" class="btn btn-warning btn-custom" data-toggle="modal"
                                    data-target="#editTaskModal" data-task-id="<?= $task_id ?>"
                                    data-task-name="<?= htmlspecialchars($task_name) ?>"
                                    data-task-description="<?= htmlspecialchars($task_description) ?>">
                                    <i class="fas fa-edit me-2"></i>Edit Task
                                </button>

                                <a href="#" class="btn btn-danger btn-custom" data-toggle="modal"
                                    data-target="#removeTaskModal" data-task-id="<?= $task_id ?>">
                                    <i class="fas fa-trash-alt me-2"></i>Delete Task
                                </a>
                            </div>
                        </div>

                        <div class="todo-list">
                            <h2 class="mb-3">
                                To-Do List
                                <span class="badge bg-info text-white ms-2">
                                    <?= $completed ?> / <?= $total ?> Completed
                                </span>
                            </h2>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 bg-white">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>To-Do</th>
                                            <th>Deadline</th>
                                            <th>Priority</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT id, name, completed, deadline, priority, progress FROM todos WHERE task_id = ?");
                                        $stmt->bind_param("i", $task_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        $current_date = new DateTime();

                                        while ($row = $result->fetch_assoc()):
                                            $deadline_date = new DateTime($row['deadline']);
                                            $is_overdue = $current_date > $deadline_date;
                                            $days_overdue = $current_date->diff($deadline_date)->days;
                                            if ($row['completed'] && $row['progress'] != 100) {
                                                $row['progress'] = 100;
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1"><?= htmlspecialchars($row['name']) ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="fw-normal mb-1"><?= htmlspecialchars($row['deadline']) ?></p>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?= getPriorityColor($row['priority']) ?> rounded-pill d-inline">
                                                        <?= htmlspecialchars($row['priority']) ?>
                                                    </span>
                                                </td>
                                                <td style="width: 20%;">
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: <?= $row['progress'] ?>%;"
                                                            aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <?= $row['progress'] ?>%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['completed']) {
                                                        $statusClass = 'success';
                                                        $statusIcon = 'fa-check-circle';
                                                        $statusText = 'Completed';
                                                    } elseif ($is_overdue) {
                                                        $statusClass = 'danger';
                                                        $statusIcon = 'fa-exclamation-circle';
                                                        $statusText = "Overdue by $days_overdue days";
                                                    } else {
                                                        $statusClass = 'warning';
                                                        $statusIcon = 'fa-clock';
                                                        $statusText = 'In Progress';
                                                    }
                                                    ?>
                                                    <span
                                                        class="badge bg-<?= $statusClass ?> text-white rounded-pill d-inline">
                                                        <i class="fas <?= $statusIcon ?> me-2"></i>
                                                        <?= $statusText ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-link btn-sm btn-rounded"
                                                        data-toggle="modal" data-target="#editTodoModal"
                                                        onclick="editTodo(<?= $row['id'] ?>, '<?= htmlspecialchars($row['name']) ?>', '<?= $row['deadline'] ?>', '<?= $row['priority'] ?>', <?= $row['progress'] ?>)">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="../todo/delete_todo.php?id=<?= $row['id'] ?>&task_id=<?= $task_id ?>"
                                                        class="btn btn-link btn-sm btn-rounded text-danger">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </a>
                                                    <a href="../todo/toggle_todo.php?id=<?= $row['id'] ?>&task_id=<?= $task_id ?>"
                                                        class="btn btn-link btn-sm btn-rounded <?= $row['completed'] ? 'text-warning' : 'text-success' ?>">
                                                        <i
                                                            class="fas <?= $row['completed'] ? 'fa-times-circle' : 'fa-check-circle' ?>"></i>
                                                        <?= $row['completed'] ? 'Mark Incomplete' : 'Mark Complete' ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile;
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include '../todo/create_todo_modal.php'; ?>
    <?php include '../todo/edit_todo_modal.php'; ?>
    <?php include '../task/remove_task_modal.php'; ?>
    <?php include '../task/edit_task_modal.php'; ?>
    <?php
    include '../project/manage_invite_modal.php';
    ?>
    <script>
        function editTodo(id, name, deadline, priority, progress) {
            $('#edit_todo_id').val(id);
            $('#edit_name').val(name);
            $('#edit_deadline').val(deadline);
            $('#edit_priority').val(priority);
            $('#edit_progress').val(progress);
        }

        $('#removeTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('task-id');
            var modal = $(this);
            modal.find('#remove_task_id').val(taskId);
        });

        $(document).ready(function () {
            // Handle form submissions with AJAX
            $('#createTodoForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../todo/create_todo.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.trim() === "success") {
                            location.reload();
                        } else {
                            alert("Error: " + response);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("An AJAX error occurred: " + status + "\nError: " + error);
                    }
                });
            });

            $('#editTodoForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../todo/edit_todo.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.trim() === "success") {
                            location.reload();
                        } else {
                            alert("Error: " + response);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("An AJAX error occurred: " + status + "\nError: " + error);
                    }
                });
            });

            $('#removeTaskForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../task/remove_task.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        var res = JSON.parse(response);
                        if (res.status === "success") {
                            location.href = "../project/view_project.php?id=<?= $project_id ?>";
                        } else {
                            alert("Error: " + res.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("An AJAX error occurred: " + status + "\nError: " + error);
                    }
                });
            });
        });
        $('#editTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var taskId = button.data('task-id'); // Extract task id from data-* attributes
            var taskName = button.data('task-name'); // Extract task name from data-* attributes
            var taskDescription = button.data('task-description'); // Extract task description from data-* attributes

            // Update the modal's content
            var modal = $(this);
            modal.find('#edit_task_id').val(taskId);
            modal.find('#editTaskName').val(taskName);
            modal.find('#editTaskDescription').val(taskDescription);
        });

        $(document).ready(function () {
            // Handle form submissions with AJAX for editing a task
            $('#editTaskForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../task/edit_task.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.trim() === "success") {
                            location.reload();
                        } else {
                            alert("Error: " + response);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("An AJAX error occurred: " + status + "\nError: " + error);
                    }
                });
            });
        });


    </script>
    <?php include '../../lib/script.php'; ?>
</body>

</html>

<?php
$conn->close();

function getPriorityColor($priority)
{
    switch (strtolower($priority)) {
        case 'high':
            return 'danger';
        case 'medium':
            return 'warning';
        case 'low':
            return 'success';
        default:
            return 'secondary';
    }
}

function getStatusBadgeClass($completed, $is_overdue)
{
    if ($completed) {
        return 'bg-success';
    } elseif ($is_overdue) {
        return 'bg-danger';
    } else {
        return 'bg-warning text-dark';
    }
}

function getStatusText($completed, $is_overdue, $days_overdue)
{
    if ($completed) {
        return 'Completed';
    } elseif ($is_overdue) {
        return "Overdue by $days_overdue days";
    } else {
        return 'In Progress';
    }
}
?>