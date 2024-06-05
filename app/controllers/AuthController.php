<?php
class AuthController extends Controller {
    public function showLoginForm() {
        $this->view('user/login');
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
                header('Location: /');
            }
        } else {
            $this->view('user/login', ['error' => 'Invalid username or password']);
        }
    }

    public function showRegisterForm() {
        $this->view('user/register');
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
            $this->view('user/register', ['error' => 'Registration failed']);
        }
    }

    public function logout() {
        $user = new User();
        $user->logout();
        header('Location: /');
    }

    public function showResetPasswordForm() {
        $this->view('user/reset_password');
    }

    public function resetPassword() {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $email = $_POST['email'];

        $user = new User();
        $token = $user->generatePasswordResetToken($email);
        if ($token) {
            // Send email with the token (simplified)
            mail($email, "Password Reset", "Here is your password reset token: $token");
            $this->view('user/reset_password', ['message' => 'Check your email for the reset token.']);
        } else {
            $this->view('user/reset_password', ['error' => 'Email not found.']);
        }
    }

    public function showNewPasswordForm() {
        $this->view('user/new_password');
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
            $this->view('user/new_password', ['error' => 'Invalid token or password reset failed.']);
        }
    }
}
