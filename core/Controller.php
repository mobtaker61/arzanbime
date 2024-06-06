<?php
class Controller {
    protected function view($view, $data = [], $layout = 'user') {
        extract($data);
        $viewPath = "app/views/$view.php";
        if ($layout === 'admin') {
            require "app/views/layouts/admin/master.php";
        } else {
            require "app/views/layouts/user/master.php";
        }
    }
}
