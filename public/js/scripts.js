// 公用的AJAX请求函数
function sendAjaxRequest(url, data, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            let response;
            try {
                response = JSON.parse(xhr.responseText);  // 解析JSON响应
                callback(null, response);
            } catch (e) {
                callback("服务器返回了无效的响应", null);  // 处理无效JSON响应
            }
        } else {
            callback('请求失败，请稍后再试', null);
        }
    };

    xhr.onerror = function () {
        callback('无法连接到服务器，请稍后再试', null);
    };

    xhr.send(data);
}

// 验证验证码
function validateCaptcha(captchaValue) {
    return new Promise(function (resolve, reject) {
        sendAjaxRequest('../../controllers/ValidateCaptcha.php', 'captcha=' + encodeURIComponent(captchaValue), function (err, response) {
            if (err) {
                reject(err);
            } else {
                if (response.success) {
                    resolve();
                } else {
                    reject(response.message);
                }
            }
        });
    });
}

// 刷新验证码
function refreshCaptcha() {
    const captchaImage = document.getElementById('captcha-image');
    const timestamp = new Date().getTime();
    captchaImage.src = '../../controllers/CaptchaController.php?' + timestamp;
}

// 处理表单提交逻辑
function handleFormSubmit(form, url) {
    form.addEventListener('submit', function (event) {
        event.preventDefault();  // 阻止默认表单提交

        const idCard = document.getElementById('id_card').value;
        const name = document.getElementById('name').value;

        // 提交表单数据
        sendAjaxRequest(url, 'id_card=' + encodeURIComponent(idCard) + '&name=' + encodeURIComponent(name), function (err, response) {
            if (err) {
                Swal.fire({
                    title: '错误',
                    text: err,
                    icon: 'error',
                    confirmButtonText: '确定'
                });
            } else {
                Swal.fire({
                    title: response.success ? '成功' : '错误',
                    text: response.message,
                    icon: response.success ? 'success' : 'error',
                    confirmButtonText: '确定'
                });
            }
        });
    });
}

// 页面加载时的初始化
document.addEventListener("DOMContentLoaded", function () {
    const fields = {
        username: document.getElementById("username"),
        password: document.getElementById("password"),
        captcha: document.getElementById("captcha")
    };

    const errors = {
        username: document.getElementById("username-error"),
        password: document.getElementById("password-error"),
        captcha: document.getElementById("captcha-error")
    };

    const containers = {
        username: fields.username ? fields.username.parentElement : null,
        password: fields.password ? fields.password.parentElement : null,
        captcha: fields.captcha ? fields.captcha.closest('.captcha-input-wrapper') : null
    };

    // 处理字段验证
    function validateField(field, errorElement, container) {
        const fieldNames = {
            username: "用户名",
            password: "密码",
            captcha: "验证码"
        };

        const fieldName = fieldNames[field.name];
        if (field.value.trim() === "") {
            errorElement.textContent = `${fieldName}不能为空！`;
            errorElement.style.display = "block";
            errorElement.style.visibility = "visible";
            field.classList.add("error");
        } else {
            errorElement.style.display = "none";
            errorElement.style.visibility = "hidden";
            field.classList.remove("error");
        }
    }

    // 绑定验证和错误信息清除
    Object.keys(fields).forEach(function (fieldName) {
        const field = fields[fieldName];
        const errorElement = errors[fieldName];
        const container = containers[fieldName];

        if (field) {
            // 失去焦点时验证
            field.addEventListener("blur", function () {
                validateField(field, errorElement, container);
            });

            // 输入时清除错误信息
            field.addEventListener("input", function () {
                if (field.value.trim() !== "") {
                    errorElement.style.display = "none";
                    errorElement.style.visibility = "hidden";
                    field.classList.remove("error");
                }
            });
        }
    });

    // 验证验证码
    const captchaField = fields.captcha;
    const captchaError = errors.captcha;
    const captchaInputWrapper = captchaField ? captchaField.closest(".captcha-input-wrapper") : null;

    if (captchaField) {
        captchaField.addEventListener("blur", function () {
            const captchaValue = captchaField.value.trim();
            if (captchaValue === "") {
                captchaError.textContent = "验证码不能为空！";
                captchaError.style.display = "block";
                captchaInputWrapper.classList.add("error");
            } else {
                validateCaptcha(captchaValue)
                    .then(function () {
                        captchaError.style.display = "none";
                        captchaInputWrapper.classList.remove("error");
                    })
                    .catch(function (message) {
                        captchaError.textContent = message;
                        captchaError.style.display = "block";
                        captchaInputWrapper.classList.add("error");
                    });
            }
        });

        // 实时输入时清除错误
        captchaField.addEventListener("input", function () {
            if (captchaField.value.trim() !== "") {
                captchaError.style.display = "none";
                captchaInputWrapper.classList.remove("error");
            }
        });
    }

    // 页面是否为重置密码页面，如果是，绑定重置密码表单的提交逻辑
    const resetPasswordForm = document.querySelector('form[action="../../controllers/resetPasswordController.php"]');
    if (resetPasswordForm) {
        handleFormSubmit(resetPasswordForm, '../../controllers/resetPasswordController.php');
    }

});

// 点击其他地方时，关闭下拉菜单
document.addEventListener('click', function (event) {
    var menu = document.getElementById('userMenu');
    var userName = document.querySelector('.user-name span');

    // 检查点击的位置是否是用户名或下拉菜单区域
    if (!userName.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.remove('show'); // 点击其他地方关闭菜单
    }
});

function redirectToDashboard(event) {
    // 阻止表单提交
    event.preventDefault();
    // 跳转到学生仪表盘页面
    window.location.href = 'http://localhost/PHP_team_project/views/auth/StudentDashboard.php';
}
