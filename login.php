<?php
session_start();



include "db_connect.php";

// Kiểm tra và khởi tạo biến $isLoggedIn
$isLoggedIn = isset($_SESSION['username']);

// Sử dụng biến $isLoggedIn
if ($isLoggedIn) {
    echo "Người dùng đã đăng nhập.";
    header("Location: index2.html");
} else {
    echo "Người dùng chưa đăng nhập.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // Lưu tên người dùng vào phiên
            header("Location: index2.html"); // Chuyển hướng đến trang chính
            exit();
        } else {
            $_SESSION['error'] = "Mật khẩu không đúng!";
        }
    } else {
        $_SESSION['error'] = "Tên đăng nhập không tồn tại!";
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="book-shop/css/login.css">
</head>
<body>
    <div class="container">
        <h2>Đăng nhập</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="login.php" method="post">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required>
<br>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
<br>
            <button type="submit">Đăng nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </div>
</body>
</html>
