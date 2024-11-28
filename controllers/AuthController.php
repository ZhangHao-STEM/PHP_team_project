// controllers/AuthController.php
require_once 'models/UserModel.php';
require_once 'models/EmailModel.php'; // 发送邮件的模型

class AuthController {
// 发送验证码
public function sendVerificationCode() {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$email = $_POST['email'];
$userModel = new UserModel();
$user = $userModel->getUserByEmail($email);

if ($user) {
// 生成验证码
$verificationCode = rand(100000, 999999);

// 存储验证码和过期时间
$_SESSION['verification_code'] = $verificationCode;
$_SESSION['verification_code_time'] = time();

// 发送验证码到邮箱
$emailModel = new EmailModel();
$emailModel->sendVerificationEmail($email, $verificationCode);

// 跳转到验证码验证页面
header('Location: views/auth/VerifyCodeView.php');
exit;
} else {
// 用户不存在
$error = '该邮箱未注册';
require_once 'views/auth/ResetPasswordView.php';
}
}
}

// 验证验证码
public function verifyCode() {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$inputCode = $_POST['verification_code'];

// 检查验证码是否正确且未过期
if ($_SESSION['verification_code'] == $inputCode && time() - $_SESSION['verification_code_time'] < 300) { // 5分钟有效
header('Location: views/auth/ResetPasswordForm.php');
exit;
} else {
$error = '验证码无效或已过期';
require_once 'views/auth/VerifyCodeView.php';
}
}
}

// 重置密码
public function resetPassword() {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$userModel = new UserModel();
$userModel->updatePassword($_SESSION['user_id'], $password);

// 清除验证码
unset($_SESSION['verification_code']);
unset($_SESSION['verification_code_time']);

header('Location: views/auth/LoginView.php');
exit;
}
}
}
