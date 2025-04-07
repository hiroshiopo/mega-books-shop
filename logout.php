<?php
session_start();
session_destroy(); // Hủy session
header("Location: index.html"); // Chuyển hướng về trang chủ
exit();
?>
