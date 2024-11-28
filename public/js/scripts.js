// 刷新验证码的函数
function refreshCaptcha() {
    var captchaImage = document.getElementById('captcha-image');  // 获取图片元素
    var timestamp = new Date().getTime();  // 获取当前时间戳
    captchaImage.src = '../../controllers/CaptchaController.php?' + timestamp;  // 使用时间戳更新图片的 URL
}