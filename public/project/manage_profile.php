<?php
session_start();
require '../../config/config.php';
require '../../lib/auth.php';
require_login();

$user_id = $_SESSION['user_id'];
$error_message = '';
$success_message = '';

// Fetch user data
$stmt = $conn->prepare("SELECT username, profile_picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$username = $user_data['username'];
$profile_picture = $user_data['profile_picture'];
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle profile picture update
    if (!empty($_FILES['profile_picture']['size'])) {
        // Get current profile picture filename
        $stmt = $conn->prepare("SELECT profile_picture FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($current_picture);
        $stmt->fetch();
        $stmt->close();

        // Directory for user's profile pictures
        $upload_dir = '../../assets/' . $user_id . '/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create the directory if it doesn't exist
        }

        // Upload new profile picture
        $filename = "profile_picture." . pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            // Delete current profile picture if it exists
            if (!empty($current_picture) && file_exists('../../' . $current_picture)) {
                unlink('../../' . $current_picture);
            }

            // Update database with new profile picture path
            $profile_picture_path = '../../assets/' . $user_id . '/' . $filename;
            $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
            $stmt->bind_param("si", $profile_picture_path, $user_id);
            $stmt->execute();
            $stmt->close();
            $profile_picture = 'assets/' . $user_id . '/' . $filename; // Update the current profile picture variable
        } else {
            $error_message = "Failed to upload profile picture.";
        }
    }

    // Handle username update
    $new_username = $_POST['username'];

    // Check if the new username is already taken
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
    $stmt->bind_param("si", $new_username, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error_message = "Username already exists. Please choose a different username.";
    } else {
        // Update username in the database
        $stmt->close(); // Close the previous statement before reusing it
        $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->bind_param("si", $new_username, $user_id);
        $stmt->execute();
        $stmt->close();

        $success_message = "Profile updated successfully.";
    }


    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <?php include '../../lib/script.php'; ?>
    <style>
        body {
            background-color: #f8f9fa;
        }

        form {
            border: 0px;
        }

        .profile-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-picture {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 2rem;
            display: block;
            border: 5px solid #007bff;
        }

        .profile-picture-container {
            position: relative;
            width: 200px;
            margin: 0 auto 2rem;
        }

        .profile-picture-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: rgba(0, 123, 255, 0.7);
            color: white;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
        }

        .btn-custom {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
    <?php include '../sidebar.php'; ?>
    <?php include '../navbar.php'; ?>

    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">
            <div class="profile-container">
                <h1 class="text-center mb-4">Manage Profile</h1>

                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success_message); ?></div>
                <?php endif; ?>

                <form action="manage_profile.php" method="post" enctype="multipart/form-data">
                    <div class="profile-picture-container">
                        <?php
                        if (empty($profile_picture)) {
                            $profile_picture = '../../assets/images/avatar.png';
                        }
                        ?>
                        <img src="<?= $profile_picture; ?>" alt="Profile Picture" class="profile-picture"
                            id="profilePicturePreview">
                        <label for="profile_picture" class="profile-picture-overlay">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" id="profile_picture" name="profile_picture" class="d-none"
                            onchange="previewProfilePicture(event)">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?= htmlspecialchars($username); ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-custom">Save Changes</button>
                        <a href="../main/logout.php" class="btn btn-danger btn-custom">Logout</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        function previewProfilePicture(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('profilePicturePreview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>