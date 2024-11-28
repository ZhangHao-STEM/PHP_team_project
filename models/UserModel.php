// models/UserModel.php
<?php
require_once 'Database.php'; // 引入数据库连接

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance(); // 获取数据库实例
    }

    // 登录验证方法
    public function login($username, $password) {
        // 防止 SQL 注入，使用预处理语句
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // 获取用户数据
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 验证密码
        if ($user && password_verify($password, $user['password'])) {
            return $user; // 登录成功，返回用户数据
        }
        return false; // 登录失败
    }
}
?>
