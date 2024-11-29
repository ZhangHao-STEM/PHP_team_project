<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单数据
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $captcha = $_POST['captcha'] ?? '';

    // 验证验证码
    if ($captcha != $_SESSION['captcha']) {
        $_SESSION['error']['captcha'] = '验证码不正确！';
    } elseif ($username == 'student' && $password == 'password') {
        header("Location: dashboard.php"); // 登录成功，跳转到报到系统主页
        exit();
    } else {
        $_SESSION['error']['login'] = '用户名或密码错误！';
    }

    // 如果有错误，重定向回登录页面
    header('Location: /PHP_team_project/views/auth/LoginView.php');
    exit();
}
