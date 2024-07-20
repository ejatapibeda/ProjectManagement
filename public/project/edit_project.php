<?php
session_start();
require '../../config/config.php';
require_once '../../lib/auth.php';
require_login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $project_name = $_POST['name'];
    $project_description = $_POST['description'];
    $bullet_color = $_POST['bullet_color'];

    $sql = "UPDATE projects SET name = ?, description = ?, bullet_color = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $project_name, $project_description, $bullet_color, $project_id);

    if ($stmt->execute()) {
        header("Location: view_project.php?id=$project_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Edit Project</h1>
        <form action="edit_project.php?id=<?php echo $project_id; ?>" method="post">
            <div class="form-group">
                <label for="name">Project Name:</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"
                    required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="form-group">
                <label for="bullet_color">Bullet Color:</label>
                <input type="color" class="form-control" id="bullet_color" name="bullet_color"
                    value="<?php echo htmlspecialchars($bullet_color); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>

</html>