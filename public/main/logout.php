<!-- Muhammad Fahreza 10123314 -->

<?php
session_start();
session_destroy();
header('Location: login.php');
exit();
?>