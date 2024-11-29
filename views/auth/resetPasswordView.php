<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重置密码</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
    <!-- 引入 SweetAlert2 的 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<h1 class="page-title">学生报到系统</h1>
<div class="reset-password-container">
    <h2>重置密码</h2>

    <form action="../../controllers/resetPasswordController.php" method="POST">
        <label for="id_card">身份证号码</label>
        <input type="text" id="id_card" name="id_card" required>

        <label for="name">姓名</label>
        <input type="text" id="name" name="name" required>

        <button type="submit">重置密码</button>
    </form>

    <p class="back-to-login">
        <a href="../../views/auth/LoginView.php">返回登录页面</a>
    </p>
</div>

<!-- 引入 SweetAlert2 的 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.1/dist/sweetalert2.min.js"></script>
<!--引入外部js-->
<script src="../../public/js/scripts.js"></script>

</body>
</html>
