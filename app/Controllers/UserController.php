<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\Quotation;
use App\Models\User;
use Core\Controller;
use Core\Middleware;
use Core\Security;
use Core\View;

class UserController extends Controller
{
    public function __construct()
    {
        Middleware::auth();  // Ensure user is authenticated
    }

    public function dashboard()
    {
        $user = new User();
        $profile = new Profile();
        $quota = new Quotation();


        $userInfo = $user->getUserById($_SESSION['user_id']);
        $profileInfo = $profile->getProfileByUserId($_SESSION['user_id']);
        $quotaInfo = $quota->getAllQuotations();

        View::render('user/dashboard', [
            'user' => $userInfo,
            'profile' => $profileInfo,
            'quotaInfo' => $quotaInfo,
            'pagetitle' => 'پنل کاربری'
        ], 'user');
    }

    public function showProfile()
    {
        $user = new User();
        $userInfo = $user->getUserById($_SESSION['user_id']);
        $this->view('user/profile', ['user' => $userInfo], 'user');
    }

    public function updateProfile()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->updateUser($_SESSION['user_id'], $username, $email, $password);

        header('Location: /profile');
    }
}
