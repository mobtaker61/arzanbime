<?php

namespace App\Controllers\Agent;

use Core\View;
use Core\Middleware;
use App\Models\User;
use App\Models\Profile;

class UserController
{
    public function __construct()
    {
        Middleware::auth();
        Middleware::agent();
    }

    public function store()
    {
        try {
            // Create user
            $userModel = new User();
            $userData = [
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => 'user',
                'agent_id' => $_SESSION['user_id'],
                'user_level_id' => 2,
                'is_active' => 1,
                'operator_user_id' => $_SESSION['user_id']
            ];
            
            $userId = $userModel->createUser($userData);
            
            if (!$userId) {
                echo json_encode(['success' => false, 'message' => 'خطا در ایجاد کاربر']);
                return;
            }

            // Create profile
            $profileModel = new Profile();
            $profileData = [
                'user_id' => $userId,
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
                'birth_date' => $_POST['birth_date'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone']
            ];
            
            if ($profileModel->createProfile($profileData)) {
                echo json_encode(['success' => true, 'message' => 'کاربر با موفقیت ایجاد شد']);
            } else {
                // Rollback user creation if profile creation fails
                $userModel->deleteUser($userId);
                echo json_encode(['success' => false, 'message' => 'خطا در ایجاد پروفایل کاربر']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'خطا در ایجاد کاربر: ' . $e->getMessage()]);
        }
    }
} 