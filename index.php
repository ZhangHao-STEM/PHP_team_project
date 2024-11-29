<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: mainPage.php');  // 用户已登录，跳转到主页面
    exit();
}
?>