<?php
// Kết nối với cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy thông tin số dư từ cơ sở dữ liệu
$sql = "SELECT balance FROM users WHERE email = 'johndoe@example.com'";
$result = $conn->query($sql);

$balance = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $balance = $row["balance"];
}

// Đóng kết nối
$conn->close();
?>
