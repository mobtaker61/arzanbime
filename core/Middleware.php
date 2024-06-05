<?php
class Middleware {
    public static function auth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
    }

    public static function admin() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: /');
            exit;
        }
    }

    public static function guest() {
        // Guests are allowed, no redirection
    }
}
