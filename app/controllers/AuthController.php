<?php
class AuthController extends Controller {
    public function showLoginForm() {
        View::render('public/auth/login', ['pagetitle' => 'Login'], 'public');
    }

    public function login() {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User();
        if ($user->login($username, $password)) {
            // Redirect based on user role
            if ($_SESSION['role'] === 'admin') {
                header('Location: /admin');
            } else {
                header('Location: /user/dashboard');
            }
        } else {
            View::render('public/auth/login', ['error' => 'Invalid username or password', 'pagetitle' => 'Login'], 'public');
        }
    }

    public function showRegisterForm() {
        View::render('public/auth/register');
    }

    public function register() {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        if ($user->register($username, $email, $password)) {
            header('Location: /login');
        } else {
            View::render('public/auth/register', ['error' => 'Registration failed']);
        }
    }

    public function logout() {
        $user = new User();
        $user->logout();
        header('Location: /login');
    }

    public function showResetPasswordForm() {
        View::render('public/auth/reset_password');
    }

    public function resetPassword() {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $email = $_POST['email'];

        $user = new User();
        $token = $user->generatePasswordResetToken($email);
        if ($token) {
            mail($email, "Password Reset", "Here is your password reset token: $token");
            View::render('public/auth/reset_password', ['message' => 'Check your email for the reset token.']);
        } else {
            View::render('public/auth/reset_password', ['error' => 'Email not found.']);
        }
    }

    public function showNewPasswordForm() {
        View::render('public/auth/new_password');
    }

    public function setNewPassword() {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];

        $user = new User();
        if ($user->resetPassword($token, $newPassword)) {
            header('Location: /login');
        } else {
            View::render('public/auth/new_password', ['error' => 'Invalid token or password reset failed.']);
        }
    }
}
