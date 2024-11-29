<?php
session_start();
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
<!-- 页面标题 -->
<h1 class="page-title">学生报到系统</h1>

<!-- 登录表单 -->
<div class="login-container">
    <form action="../../controllers/AuthController.php" method="POST" class="login-form">
        <form action="../../controllers/AuthController.php" method="POST" class="login-form">
            <h2>登录</h2>

            <label for="username">用户名</label>
            <input type="text" name="username" id="username" required>
            <div class="error-message" id="username-error"></div>

            <label for="password">密码</label>
            <input type="password" name="password" id="password" required>
            <div class="error-message" id="password-error"></div>

            <label for="captcha">验证码</label>
            <div class="captcha-wrapper">
                <div class="captcha-input-wrapper">
                    <input type="text" name="captcha" id="captcha" required class="captcha-input">
                    <div class="error-message" id="captcha-error"></div>
                </div>
                <img src="../../controllers/CaptchaController.php?<?= time(); ?>" class="captcha-image" id="captcha-image" onclick="refreshCaptcha();" alt="验证码">
            </div>


            <button type="submit" class="submit-btn">登录</button>
            <a href="resetPasswordView.php" class="reset-link">重置密码</a>
        </form>
</div>

<!--引入外部js-->
<script src="../../public/js/scripts.js"></script>
</body>
</html>
