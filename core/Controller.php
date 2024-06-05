<?php
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        $viewPath = "app/views/$view.php";
        require "app/views/layouts/master.php";
    }
}
