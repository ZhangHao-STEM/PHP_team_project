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
$line_color = imagecolorallocate($image, 200, 200, 200); // 干扰线颜色

// 填充背景颜色
imagefill($image, 0, 0, $bg_color);

// 生成4位随机验证码并保存到会话中
$captcha = rand(1000, 9999);
$_SESSION['captcha'] = $captcha;

// 在图片上添加干扰线
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// 在图片上添加验证码文本
$font = dirname(__FILE__) . '/fonts/Arial.ttf'; // 字体文件路径，确保该路径存在或者更改为系统字体

// 如果找不到字体文件，可以使用内建的字体
if (!file_exists($font)) {
    $font = 5; // 默认的内建字体
    imagestring($image, $font, 30, 10, $captcha, $text_color);
} else {
    imagettftext($image, 20, rand(-15, 15), rand(20, 40), rand(25, 35), $text_color, $font, $captcha);
}

// 输出图片
header('Content-Type: image/png');
imagepng($image);

// 释放内存
imagedestroy($image);
?>
