<?php
class UserController extends Controller {
    public function __construct() {
        Middleware::auth();  // Ensure user is authenticated
    }

    public function showProfile() {
        $user = new User();
        $userInfo = $user->getUserById($_SESSION['user_id']);
        $this->view('user/profile', ['user' => $userInfo]);
    }

    public function updateProfile() {
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
