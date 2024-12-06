<?php
// 开始会话
session_start();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生报到系统 - 学生主页</title>
    <link rel="stylesheet" href="../../public/css/index.css"> <!-- 引入全局样式 -->
</head>
<body>
<!-- 引入公共头部组件 -->
<?php include('../shared/Header.php'); ?>

<div class="container">
    <!-- 引入公共侧边栏组件 -->
    <?php include('../shared/Sidebar.php'); ?>

    <main class="main-content">
        <!--页面主体内容，学生主页内容-->
        <h2>欢迎,张三</h2>
        <p>这是您的学生主页，您可以在这里查看和更新您的个人信息，缴纳学费等。</p>

        <section class="student-info">
            <h3>个人信息</h3>
            <!--这里可以插入具体的学生信息内容，如姓名、学号等-->
            <p>姓名：张三</p>
            <p>学号：2024001</p>
        </section>

        <section class="student-actions">
            <h3>告新生的一封信</h3>
            <div class="letter-content">
                <p>亲爱的同学们：</p>

                <p>欢迎你们加入我们学校！在你们踏入校园的这一天，意味着你们的大学生活正式开始了。我们深知，这段时间你们可能会有许多的疑问和不安，但请相信，这里将是你们学习、成长和收获的地方。</p>

                <p>首先，请你们务必按照学校的规定进行报到，确保所有的手续都顺利完成。接下来，你们将逐步适应校园生活，遇到任何问题，请随时与我们联系。</p>

                <p>除了报到，学校还为你们准备了丰富的活动和学习资源，希望你们能够充分利用这些机会，提升自己，和同学们一起共同成长。</p>

                <p>我们期待在未来的日子里，见证你们的成就和成长！</p>

                <p>祝愿你们一切顺利，学业有成！</p>

                <p>学校全体师生 敬上</p>
            </div>
        </section>

    </main>
</div>

<!-- 引入公共尾部组件 -->
<?php include('../shared/Footer.php'); ?>

</body>
</html>
