<?php

namespace Core;

use App\Models\Profile;

class Middleware {
    public static function auth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public static function admin() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
    }

    public static function agent() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'agent') {
            header('Location: /login');
            exit();
        }
    }

    public static function loadUserData() {
        if (isset($_SESSION['user_id'])) {
            error_log("Middleware::loadUserData - Loading data for user ID: " . $_SESSION['user_id']);
            
            if (!isset($_SESSION['user_role'])) {
                error_log("WARNING: user_role not set in session");
                
                // Try to fetch user role from database
                $userModel = new \App\Models\User();
                $user = $userModel->getUserById($_SESSION['user_id']);
                if ($user && isset($user['role'])) {
                    $_SESSION['user_role'] = $user['role'];
                    error_log("Setting user_role to: " . $user['role']);
                }
            }
            
            $profileModel = new Profile();
            $user = $profileModel->getProfileByUserId($_SESSION['user_id']);
            if ($user) {
                $_SESSION['user_data'] = $user;
                error_log("User data loaded successfully");
            } else {
                error_log("WARNING: Could not load profile data for user ID: " . $_SESSION['user_id']);
            }
        }
    }
}
