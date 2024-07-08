<?php

namespace Core;

use App\Models\Profile;

class Middleware {
    public static function auth() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public static function admin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
    }

    public static function agent() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'agent') {
            header('Location: /login');
            exit();
        }
    }

    public static function loadUserData() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $profileModel = new Profile();
            $user = $profileModel->getProfileByUserId($_SESSION['user_id']);
            if ($user) {
                $_SESSION['user_data'] = $user;
            }
        }
    }
}
