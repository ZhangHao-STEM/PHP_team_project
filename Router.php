<?php
class Router {
    private $routes = [];

    public function __construct() {
        // 定义路由规则
        $this->routes = [
            'login' => 'AuthController@login',          // 登录页面
            'logout' => 'AuthController@logout',        // 注销功能
            'student/edit' => 'StudentController@edit', // 学生信息维护
            // 更多路由可以在此扩展
        ];
    }

    public function run() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
        $path = str_replace($base_url, '', $path);

        if (isset($this->routes[$path])) {
            $this->dispatch($this->routes[$path]);
        } else {
            echo "404 Not Found";
        }
    }

    private function dispatch($controllerAction) {
        list($controller, $action) = explode('@', $controllerAction);

        // 自动加载控制器
        require_once "controllers/$controller.php";
        $controllerInstance = new $controller();

        // 调用指定方法
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            echo "404 Action Not Found";
        }
    }
}
?>
