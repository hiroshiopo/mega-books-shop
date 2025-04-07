<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    echo "Thông tin kết nối:<br>";
    echo "Server: $servername<br>";
    echo "Username: $username<br>";
    echo "Database: $dbname<br>";
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    
}
?>
