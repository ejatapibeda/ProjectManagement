<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$current_url = $_SERVER['REQUEST_URI'];
$show_projects_menu = strpos($current_url, '/main/index.php') !== false;
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="../main/index.php" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                    </a>
                    <?php if ($show_projects_menu): ?>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="collapse"
                            data-mdb-target="#projectsMenu" aria-expanded="false">
                            <i class="fas fa-folder-open fa-fw me-3"></i><span>Projects</span>
                        </a>
                        <div id="projectsMenu" class="collapse">
                            <?php if (isset($sidebar_projects) && !empty($sidebar_projects)): ?>
                                <?php foreach ($sidebar_projects as $project): ?>
                                    <a href="../project/view_project.php?id=<?php echo htmlspecialchars($project['id']); ?>"
                                        class="list-group-item list-group-item-action py-2 ripple">
                                        <span style="color: <?php echo htmlspecialchars($project['bullet_color']); ?>">●</span>
                                        <?php echo htmlspecialchars($project['name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="list-group-item">No projects available.</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($show_projects_menu): ?>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="modal"
                            data-mdb-target="#createProjectModal">
                            <i class="fas fa-folder-plus fa-fw me-3"></i><span>Create New Project</span>
                        </a>
                    <?php endif; ?>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="modal"
                        data-mdb-target="#manageInvitesModal">
                        <i class="fas fa-envelope fa-fw me-3"></i><span>Manage Invites</span>
                    </a>
                    <a href="../main/logout.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-sign-out-alt fa-fw me-3"></i><span>Logout</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
    </header>
    <!-- Modal Create Project -->
    <?php include '../project/create_project_modal.php'; ?>
</body>

</html>