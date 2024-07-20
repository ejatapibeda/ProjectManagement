<?php

// Database operations
function fetchProjects($conn, $user_id)
{
    $stmt = $conn->prepare("SELECT id, name, bullet_color FROM projects WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $projects = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $projects;
}

function fetchProjectDetails($conn, $project_id)
{
    $stmt = $conn->prepare("SELECT name, description FROM projects WHERE id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->store_result();
    $name = null;
    $description = null;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $description);
        $stmt->fetch();
        $stmt->close();
        return ['name' => $name, 'description' => $description];
    }
    $stmt->close();
    return null;
}

function fetchTasks($conn, $project_id)
{
    $stmt = $conn->prepare("SELECT id, name FROM tasks WHERE project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $tasks;
}

function getInviteCount($conn, $project_id)
{
    $count = 0; // Initialize $count with a default value
    $stmt = $conn->prepare("SELECT COUNT(*) FROM invites WHERE project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count;
}

// Fetch data
$projects = fetchProjects($conn, $_SESSION['user_id']);
$project_details = fetchProjectDetails($conn, $project_id);
if (!$project_details) {
    echo "Project not found.";
    exit();
}
$tasks = fetchTasks($conn, $project_id);
$invite_count = getInviteCount($conn, $project_id);

?>