<?php
session_start();

// 设置验证码图片的宽度和高度
$width = 120;
$height = 40;

// 创建一个空白的图像
$image = imagecreatetruecolor($width, $height);

// 设置颜色
$bg_color = imagecolorallocate($image, 240, 240, 240); // 背景颜色
$text_color = imagecolorallocate($image, 0, 0, 0); // 字体颜色
$line_color = imagecolorallocate($image, 150, 150, 100); // 干扰线颜色
$dot_color = imagecolorallocate($image, 0, 0, 0); // 噪点颜色

// 填充背景颜色
imagefill($image, 0, 0, $bg_color);

// 生成一个更复杂的验证码，包括数字、大小写字母
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$captcha = '';
for ($i = 0; $i < 4; $i++) {  // 生成 4 个字符的验证码
    $captcha .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha'] = $captcha;

// 在图片上添加干扰线
for ($i = 0; $i < 6; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// 在图片上添加噪点
for ($i = 0; $i < 200; $i++) {
    imagesetpixel($image, rand(0, $width), rand(0, $height), $dot_color);
}

// 添加验证码字符，随机位置和角度
$font = dirname(__FILE__) . 'C:\Windows\Fonts\Arial.ttf'; // 字体文件路径

// 如果找不到字体文件，可以使用内建的字体
if (!file_exists($font)) {
    $font = 5; // 默认的内建字体
    for ($i = 0; $i < strlen($captcha); $i++) {
        imagestring($image, $font, 20 + ($i * 25), rand(5, 15), $captcha[$i], $text_color);
    }
} else {
    // 字体大小
    $font_size = 50;

    // 对每个字符使用不同的随机角度和位置
    for ($i = 0; $i < strlen($captcha); $i++) {
        $angle = rand(-30, 30); // 随机角度
        $x = ($i * 30) + rand(5, 10); // 增加间距
        $y = rand(30, 35); // 调整字符垂直位置
        imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font, $captcha[$i]);
    }
}

// 输出图片
header('Content-Type: image/png');
imagepng($image);

// 释放内存
imagedestroy($image);
?>
