// index.php
<?php
require_once 'config/session.php'; // 引入会话配置

// 判断用户是否已登录
if (isset($_SESSION['user_id'])) {
    // 已登录，跳转到学生主页或管理员主页（根据实际情况）
    header('Location: views/dashboard/SystemRedirectView.php');
    exit;
} else {
    // 未登录，跳转到登录页面
    header('Location: views/auth/LoginView.php');
    exit;
}
?>
