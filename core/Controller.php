<?php
namespace Core;

require_once __DIR__ . '/NotificationCenter.php';
require_once __DIR__ . '/ObserverInterface.php';
require_once __DIR__ . '/ConsoleObserver.php';
require_once __DIR__ . '/TelegramObserver.php';
require_once __DIR__ . '/JavaScriptAlertObserver.php';
require_once __DIR__ . '/IMVerify.php';

require_once __DIR__ . '/../vendor/autoload.php'; // مسیر را با توجه به ساختار پروژه خود تنظیم کنید

class Controller {
    protected $notificationCenter;

    public function __construct() {
        Middleware::loadUserData();
        
        $this->notificationCenter = new NotificationCenter();
        
        // Attach observers with types
        $this->notificationCenter->attach(new ConsoleObserver(), 'console');
        $this->notificationCenter->attach(new TelegramObserver('5822956113:AAHQ9gsbWF3zaku0-mbPAB9vXEH8Encc_Fo', '146767798'), 'telegram');
        $this->notificationCenter->attach(new JavaScriptAlertObserver(), 'javascript_alert');
        $this->notificationCenter->attach(new IMVerify(), 'sms');
    }

    protected function notify($message, $targets = []) {
        $this->notificationCenter->notify($message, $targets);
    }

    protected function view($view, $data = [], $layout = 'user') {
        extract($data);
        ob_start();
        $viewPath = "app/views/$view.php";
        $content = ob_get_clean();
        if ($layout === 'admin') {
            require "app/views/layouts/admin/master.php";
        } else if ($layout === 'user') {
            require "app/views/layouts/user/master.php";
        } else if ($layout === 'agent') {
            require "app/views/layouts/agent/master.php";
        } else {
            require "app/views/layouts/public/master.php";
        }
    }

    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
}
