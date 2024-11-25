<?php
// 开启会话
session_start();

// 设置会话超时时间（可选）
ini_set('session.gc_maxlifetime', 3600); // 设置为 1 小时
session_set_cookie_params(3600);

// 验证用户是否已登录
if (!isset($_SESSION['is_logged_in'])) {
    $_SESSION['is_logged_in'] = false;  // 默认未登录
}
?>
