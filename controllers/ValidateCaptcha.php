<?php
session_start();

// 获取前端传来的验证码
$captcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';

// 验证验证码是否正确
if ($captcha === $_SESSION['captcha']) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => '验证码错误！']);
}
?>
