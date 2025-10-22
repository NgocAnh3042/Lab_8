<?php
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP mặc định
$dbname = "list_mail";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
