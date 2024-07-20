<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

require '../../config/config.php';
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : "";
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : "";
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);

// Query to fetch projects where the user is the owner
$stmt = $conn->prepare(
    "SELECT p.id, p.name, p.bullet_color 
     FROM projects p 
     WHERE p.user_id = ?"
);

if (!$stmt) {
    die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    die("Execution failed: (" . $stmt->errno . ") " . $stmt->error);
}

$stmt->bind_result($project_id, $project_name, $bullet_color);
$my_projects = [];
while ($stmt->fetch()) {
    $my_projects[] = ['id' => $project_id, 'name' => $project_name, 'bullet_color' => $bullet_color];
}

$stmt->close();

// Query to fetch projects where the user is a member
$shared_stmt = $conn->prepare(
    "SELECT p.id, p.name, p.bullet_color 
     FROM projects p 
     LEFT JOIN project_members pm ON p.id = pm.project_id 
     WHERE pm.user_id = ?"
);

if (!$shared_stmt) {
    die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
}

$shared_stmt->bind_param("i", $user_id);

if (!$shared_stmt->execute()) {
    die("Execution failed: (" . $shared_stmt->errno . ") " . $shared_stmt->error);
}

$shared_stmt->bind_result($shared_project_id, $shared_project_name, $shared_bullet_color);
$shared_projects = [];
while ($shared_stmt->fetch()) {
    $shared_projects[] = ['id' => $shared_project_id, 'name' => $shared_project_name, 'bullet_color' => $shared_bullet_color];
}

$shared_stmt->close();

$my_project_count = count($my_projects);
$shared_project_count = count($shared_projects);

// Query to fetch invites
$invite_stmt = $conn->prepare(
    "SELECT invites.id, projects.name 
     FROM invites 
     JOIN projects ON invites.project_id = projects.id 
     WHERE invites.email = ?"
);

if (!$invite_stmt) {
    die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
}

$invite_stmt->bind_param("s", $email);

if (!$invite_stmt->execute()) {
    die("Execution failed: (" . $invite_stmt->errno . ") " . $invite_stmt->error);
}

$invite_stmt->bind_result($invite_id, $invited_project_name);
$invites = [];
while ($invite_stmt->fetch()) {
    $invites[] = ['id' => $invite_id, 'name' => $invited_project_name];
}
$invite_stmt->close();
$invite_count = count($invites);


$my_project_count = count($my_projects);
$shared_project_count = count($shared_projects);

// Combine projects for sidebar
$sidebar_projects = array_merge($my_projects, $shared_projects);

// Include Sidebar with combined projects
include '../sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TaskManagement - Dashboard</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
</head>

<body>
    <!-- Include Sidebar -->
    <?php include '../sidebar.php'; ?>

    <!-- Include Navbar -->
    <?php include '../navbar.php'; ?>

    <main style="margin-top: 58px">
        <div class="container pt-4">
            <?php if ($success_message): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success_message; ?>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row mb-4">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                        <h4 class="mb-3 mb-md-0"><i class="fas fa-folder-open me-2"></i>My Projects</h4>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-primary btn-sm" data-mdb-toggle="modal"
                                data-mdb-target="#createProjectModal">
                                <i class="fas fa-plus-circle me-2"></i>New Project
                            </button>
                            <button type="button" class="btn btn-info btn-sm" data-mdb-toggle="modal"
                                data-mdb-target="#manageInvitesModal">
                                <i class="fas fa-envelope me-2"></i>Invites
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="location.href='../main/logout.php'">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">My Projects</h5>
                            <ul class="list-group list-group-flush">
                                <?php if (empty($my_projects)): ?>
                                    <li class="list-group-item">No projects found.</li>
                                <?php else: ?>
                                    <?php foreach ($my_projects as $project): ?>
                                        <li class="list-group-item">
                                            <a href="../project/view_project.php?id=<?php echo htmlspecialchars($project['id']); ?>"
                                                class="d-flex align-items-center text-decoration-none text-dark">
                                                <span class="me-2"
                                                    style="color: <?php echo htmlspecialchars($project['bullet_color']); ?>">●</span>
                                                <span
                                                    class="flex-grow-1"><?php echo htmlspecialchars($project['name']); ?></span>
                                                <i class="fas fa-chevron-right text-muted"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Shared Projects</h5>
                            <ul class="list-group list-group-flush">
                                <?php if (empty($shared_projects)): ?>
                                    <li class="list-group-item">No shared projects found.</li>
                                <?php else: ?>
                                    <?php foreach ($shared_projects as $project): ?>
                                        <li class="list-group-item">
                                            <a href="../project/view_project.php?id=<?php echo htmlspecialchars($project['id']); ?>"
                                                class="d-flex align-items-center text-decoration-none text-dark">
                                                <span class="me-2"
                                                    style="color: <?php echo htmlspecialchars($project['bullet_color']); ?>">●</span>
                                                <span
                                                    class="flex-grow-1"><?php echo htmlspecialchars($project['name']); ?></span>
                                                <i class="fas fa-chevron-right text-muted"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-sm-6 col-lg-12 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-danger"><i class="fas fa-rocket me-2"></i>Projects</h5>
                                    <p class="card-text display-4">
                                        <?php echo $my_project_count + $shared_project_count; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-success"><i class="far fa-user me-2"></i>Invites</h5>
                                    <p class="card-text display-4"><?php echo $invite_count; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal for Create Project -->
    <?php include '../project/create_project_modal.php'; ?>

    <!-- Modal for Manage Invites -->
    <?php include '../project/manage_invite_modal.php'; ?>

    <?php include '../../lib/script.php'; ?>
</body>

</html>

<?php
$conn->close();
?>