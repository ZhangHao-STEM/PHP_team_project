<?php
session_start();
require_once ('../models/Database.php');  // 引入数据库类

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单数据
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $captcha = $_POST['captcha'] ?? '';

    // 验证验证码
    if ($captcha != $_SESSION['captcha']) {
        $_SESSION['error']['captcha'] = '验证码不正确！';
    } else {
        try {
            // 获取数据库实例
            $pdo = Database::getInstance();

            // 使用准备语句查询数据库，避免 SQL 注入
            $stmt = $pdo->prepare('SELECT id, username, password, role FROM users WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // 验证用户是否存在及密码是否正确
            if ($user && password_verify($password, $user['password'])) {
                // 登录成功，设置会话变量
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // 根据角色进行跳转
                if ($user['role'] == 'student') {
                    header("Location: ../views/auth/StudentDashboard.php");
                } elseif ($user['role'] == 'admin') {
                    header("Location: ../views/auth/AdminDashboard.php");
                } else {
                    $_SESSION['error']['role'] = '未知角色！';
                    header('Location: ../views/auth/LoginView.php');
                }
                exit();
            } else {
                $_SESSION['error']['login'] = '用户名或密码错误！';
            }
        } catch (PDOException $e) {
            $_SESSION['error']['db'] = '数据库连接失败！';
        }
    }

    // 如果有错误，重定向回登录页面
    header('Location: ../views/auth/LoginView.php');
    exit();
}
?>
