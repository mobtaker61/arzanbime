<?php
require_once 'NotificationCenter.php';
require_once 'ObserverInterface.php';
require_once 'ConsoleObserver.php';
require_once 'TelegramObserver.php';
require_once 'JavaScriptAlertObserver.php';

class Controller {
    protected $notificationCenter;

    public function __construct() {
        $this->notificationCenter = new NotificationCenter();
        
        // Attach observers with types
        $this->notificationCenter->attach(new ConsoleObserver(), 'console');
        $this->notificationCenter->attach(new TelegramObserver('5822956113:AAHQ9gsbWF3zaku0-mbPAB9vXEH8Encc_Fo', '146767798'), 'telegram');
        $this->notificationCenter->attach(new JavaScriptAlertObserver(), 'javascript_alert');
    }

    protected function notify($message, $targets = []) {
        $this->notificationCenter->notify($message, $targets);
    }

    protected function view($view, $data = [], $layout = 'user') {
        extract($data);
        $viewPath = "app/views/$view.php";
        if ($layout === 'admin') {
            require "app/views/layouts/admin/master.php";
        } else if ($layout == false){
            require "app/views/layouts/partial.php";
        } else {
            require "app/views/layouts/user/master.php";
        }
    }

    protected function view2($view, $data = [], $layout = 'default') {
        extract($data);

        if ($layout !== false) {
            // Include the master layout
            include "app/views/layouts/{$layout}/header.php";
        }

        include "app/views/{$view}.php";

        if ($layout !== false) {
            // Include the master layout footer
            include "app/views/layouts/{$layout}/footer.php";
        }
    }

    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
}
