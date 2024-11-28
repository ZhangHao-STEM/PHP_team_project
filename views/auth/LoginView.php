<?php
// 启动会话，生成验证码
session_start();
if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = rand(1000, 9999);
}

$error = ''; // 错误信息初始化

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单数据
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $captcha = $_POST['captcha'] ?? '';

    // 验证验证码
    if ($captcha != $_SESSION['captcha']) {
        $error = "验证码不正确！";
    } elseif ($username == 'student' && $password == 'password') {
        header("Location: dashboard.php"); // 登录成功，跳转到报到系统主页
        exit();
    } else {
        $error = "用户名或密码错误！";
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生报到系统 - 登录</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
<div class="login-container">
    <h1>学生报到系统</h1>
    <form action="login.php" method="POST" class="login-form">
        <h2>登录</h2>

        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <label for="username">用户名</label>
        <input type="text" name="username" id="username" required>

        <label for="password">密码</label>
        <input type="password" name="password" id="password" required>

        <label for="captcha">验证码</label>
        <div class="captcha-wrapper">
            <input type="text" name="captcha" id="captcha" required class="captcha-input">
            <img src="../../controllers/CaptchaController.php?<?= time(); ?>" class="captcha-image" id="captcha-image" onclick="refreshCaptcha();" alt="">
        </div>

        <button type="submit" class="submit-btn">登录</button>
        <a href="reset_password.php" class="reset-link">忘记密码？</a>
    </form>
</div>

<script src="../../public/js/scripts.js"></script>

</body>
</html>
