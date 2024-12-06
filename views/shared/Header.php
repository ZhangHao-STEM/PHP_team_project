<header class="header">
    <div class="header-content">
        <!-- 标题部分居中 -->
        <div class="logo">
            <h1>学生报到系统</h1>
        </div>

        <!-- 功能部分：头像、用户名、下拉菜单 -->
        <div class="user-info">
            <?php
            $userAvatar = isset($_SESSION['user_avatar']) ? $_SESSION['user_avatar'] : 'default-avatar.png';
            $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '未知用户';
            ?>

            <div class="avatar">
                <img src="../../public/assets/<?php echo $userAvatar; ?>" alt="User Avatar" class="user-avatar">
            </div>

            <div class="user-name">
                <span>张三</span>
            </div>

            <div class="user-menu">
                <select onchange="location = this.value;">
                    <option value="#">用户设置</option>
                    <option value="userDetails.php">用户详情</option>
                    <option value="changePassword.php">修改密码</option>
                    <option value="logout.php">退出登录</option>
                </select>
        </div>
    </div>
</header>
