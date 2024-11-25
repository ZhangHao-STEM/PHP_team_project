# 学生报到管理系统

该项目是一个用于学生报到的管理系统，采用 MVC 架构设计，实现了学生登录、信息维护、缴费、宿舍选择等功能。系统支持学生和管理员两个角色，并具有不同的权限和功能。

## 项目结构

```bash
project/
├── controllers/                        // 控制器目录
│   ├── AuthController.php              // 登录、注销、会话验证控制器
│   ├── StudentController.php           // 学生功能控制器
│   ├── PaymentController.php           // 缴费功能控制器
│   ├── DormitoryController.php         // 宿舍分配功能控制器
│   ├── DashboardController.php         // 报到完成后的假跳转控制器
│   ├── AdminController.php             // 管理员功能控制器
│   └── ErrorController.php             // 错误处理控制器
├── models/                             // 模型目录
│   ├── UserModel.php                   // 用户数据模型
│   ├── StudentModel.php                // 学生数据模型
│   ├── PaymentModel.php                // 缴费数据模型
│   ├── DormitoryModel.php              // 宿舍分配数据模型
│   ├── AdminModel.php                  // 管理员数据模型
│   └── Database.php                    // 数据库连接与操作封装
├── views/                              // 视图目录
│   ├── auth/                           // 登录与身份视图
│   │   ├── LoginView.php               // 登录页面
│   │   ├── LogoutView.php              // 注销确认页面
│   │   ├── AdminDashboard.php          // 管理员主页
│   │   ├── StudentDashboard.php        // 学生主页
│   ├── student/                        // 学生视图
│   │   ├── InfoEditView.php            // 学生个人信息维护页面
│   │   ├── RegistrationComplete.php    // 报到完成跳转页面
│   ├── payment/                        // 缴费视图
│   │   ├── PaymentFormView.php         // 缴费页面
│   │   ├── PaymentSuccessView.php      // 缴费成功页面
│   ├── dormitory/                      // 宿舍分配视图
│   │   ├── DormSelectionView.php       // 宿舍选择页面
│   │   ├── DormConfirmView.php         // 宿舍选择确认页面
│   ├── admin/                          // 管理员视图
│   │   ├── ManageStudentsView.php      // 管理学生页面
│   │   ├── ManagePaymentsView.php      // 管理缴费页面
│   │   ├── ManageDormitoriesView.php   // 管理宿舍页面
│   ├── dashboard/                      // 报到完成跳转页面
│   │   ├── SystemRedirectView.php      // 假跳转到学生管理系统
│   └── shared/                         // 公共视图（头部、导航等）
│       ├── Header.php                  // 页面头部
│       └── Footer.php                  // 页面尾部
├── public/                             // 静态资源目录
│   ├── css/                            // 样式文件目录
│   │   ├── styles.css                  // 全局样式文件
│   ├── js/                             // JavaScript 文件目录
│   │   ├── scripts.js                  // 全局 JavaScript 文件
│   └── assets/                         // 图片等静态资源
│       ├── logo.png                    // 系统 Logo
│       └── default-avatar.png          // 默认用户头像
├── config/                             // 配置文件目录
│   ├── config.php                      // 全局配置（如数据库配置）
│   ├── routes.php                      // 路由配置文件
│   └── session.php                     // 会话配置文件
├── index.php                           // 项目入口文件
├── Router.php                          // 路由器文件
└── .htaccess                           // URL 重写规则
