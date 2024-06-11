<?php
class View {
    public static function render($view, $data = [], $layout = 'public') {
        extract($data);
        ob_start();
        require "app/views/$view.php";
        $content = ob_get_clean();
        require "app/views/layouts/{$layout}/master.php";
    }
}
?>
