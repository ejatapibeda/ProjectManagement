<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

$project_id = isset($_POST['project_id']) ? $_POST['project_id'] : (isset($_GET['project_id']) ? $_GET['project_id'] : null);

if ($project_id === null) {
    echo "Project ID is missing.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Periksa apakah email terdaftar
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Insert invite into database
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO invites (project_id, email) VALUES (?, ?)");
        $stmt->bind_param("is", $project_id, $email);
        if ($stmt->execute()) {
            echo "Invitation sent.";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Email is not registered.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invite Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Invite Member</h1>
        <form action="invite_member.php" method="post">
            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Invite</button>
        </form>
    </div>
</body>

</html>