<?php
session_start();

// 模拟从数据库获取用户信息的函数（在实际应用中，这部分应该从数据库中查询）
function getUserByIdCard($id_card) {
    // 这里你可以从数据库中查找用户
    // 例如：SELECT * FROM users WHERE id_card = $id_card;

    // 为了演示，这里硬编码一个用户，实际应用应该查数据库
    if ($id_card === '123456789012345678') {
        return [
            'id_card' => '123456789012345678',
            'name' => '张三'
        ];
    }

    return null; // 未找到用户
}

// 检查POST请求
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单数据
    $id_card = $_POST['id_card'];
    $name = $_POST['name'];

    // 获取数据库中的用户信息
    $user = getUserByIdCard($id_card);

    // 验证用户信息
    if ($user && $user['name'] === $name) {
        // 执行密码重置逻辑，例如更新数据库中的密码

        // 密码重置成功，返回成功消息
        echo json_encode(['success' => true, 'message' => '密码重置成功！']);
    } else {
        // 身份验证失败，返回错误消息
        echo json_encode(['success' => false, 'message' => '身份证号码或姓名不匹配！']);
    }
} else {
    // 如果不是 POST 请求，返回错误
    echo json_encode(['success' => false, 'message' => '请求方式错误！']);
}
