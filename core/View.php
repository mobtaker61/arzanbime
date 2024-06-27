<?php
namespace Core;

class View {
    public static function render($view, $data = [], $layout = 'public') {
        extract($data);
        $content = self::getContent($view, $data);

        if ($layout === 'public') {
            require "app/views/layouts/public/master.php";
        } elseif ($layout === 'user') {
            require "app/views/layouts/user/master.php";
        } elseif ($layout === 'admin') {
            require "app/views/layouts/admin/master.php";
        }
    }

    public static function getContent($view, $data = []) {
        extract($data);
        ob_start();
        require "app/views/$view.php";
        return ob_get_clean();
    }
}
