<?php
session_start();
include "db_connect.php";

// Debug kết nối
if (!isset($conn)) {
    die("Kết nối thất bại: Biến \$conn không tồn tại.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Kiểm tra xem username đã tồn tại hay chưa
    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.";
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Đăng ký thành công!";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Lỗi: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="book-shop/css/register.css">
</head>
<body>
    <div class="container">
        <h2>Đăng ký</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="register.php" method="post">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required>
<br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
<br>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
<br>
            <button type="submit">Đăng ký</button>
        </form>
        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>
