// config/session.php
<?php
// 开启会话
session_start();

// 设置会话过期时间（可选）
ini_set('session.gc_maxlifetime', 3600); // 1小时过期
?>
