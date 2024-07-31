<!-- Muhammad Fahreza 10123314 -->

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_management_system"; //edit this with your database name
$base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/proj/'; //when using localhost edit `/proj/` with your folder name
//$base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/'; //when not using localhost


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>