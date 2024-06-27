<?php

namespace App\Controllers;

use App\Models\Quotation;
use App\Models\User;
use Core\Controller;
use Core\Security;
use Core\View;
use Core\IMVerify;

class AuthController extends Controller
{
    private $imVerify;
    public function __construct()
    {
        parent::__construct();
        $this->imVerify = new IMVerify();
    }

    public function showLoginForm()
    {
        View::render('public/auth/login', ['pagetitle' => 'Login'], 'public');
    }

    public function login()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User();
        if ($user->login($username, $password)) {
            // Redirect based on user role
            switch ($_SESSION['role']) {
                case 'admin':
                    header('Location: /admin');
                    break;
                case 'agent':
                    header('Location: /agent');
                    break;
                default:
                    header('Location: /user/dashboard');
                    break;
            }
            exit(); // Ensure no further code is executed after the redirection
        } else {
            View::render('public/auth/login', ['error' => 'Invalid username or password', 'pagetitle' => 'Login'], 'public');
        }
    }

    public function showRegisterForm()
    {
        View::render('public/auth/register', ['pagetitle' => 'Register'], 'public');
    }

    public function register()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'] ?? 'user';

        $user = new User();
        if ($user->register($username, $email, $password, $role)) {
            header('Location: /login');
            exit();
        } else {
            View::render('public/auth/register', ['error' => 'Registration failed', 'pagetitle' => 'Register'], 'public');
        }
    }

    public function logout()
    {
        $user = new User();
        $user->logout();
        header('Location: /login');
        exit();
    }

    public function showResetPasswordForm()
    {
        View::render('public/auth/reset_password', ['pagetitle' => 'Reset Password'], 'public');
    }

    public function resetPassword()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $email = $_POST['email'];

        $user = new User();
        $token = $user->generatePasswordResetToken($email);
        if ($token) {
            mail($email, "Password Reset", "Here is your password reset token: $token");
            View::render('public/auth/reset_password', ['message' => 'Check your email for the reset token.', 'pagetitle' => 'Reset Password'], 'public');
        } else {
            View::render('public/auth/reset_password', ['error' => 'Email not found.', 'pagetitle' => 'Reset Password'], 'public');
        }
    }

    public function showNewPasswordForm()
    {
        View::render('public/auth/new_password', ['pagetitle' => 'New Password'], 'public');
    }

    public function setNewPassword()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];

        $user = new User();
        if ($user->resetPassword($token, $newPassword)) {
            header('Location: /login');
            exit();
        } else {
            View::render('public/auth/new_password', ['error' => 'Invalid token or password reset failed.', 'pagetitle' => 'New Password'], 'public');
        }
    }

    public function sendOTP()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $tel = preg_replace('/\s+/', '', $data['tel']); // Remove spaces

        if ($this->imVerify->send($tel)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send OTP']);
        }
    }

    public function verifyOTP()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $otp = $data['otp'];

        if ($this->imVerify->checkIsValid($otp)) {
            // Store the data in the quotations table
            $quotationModel = new Quotation();
            $quotationData = [
                'birth' => $_SESSION['quotation_data']['birth'],
                'age' => $_SESSION['quotation_data']['age'],
                'duration' => $_SESSION['quotation_data']['duration'],
                'tel' => $_SESSION['quotation_data']['tel'],
            ];
            $uid = $quotationModel->createQuotation($quotationData);

            // Clear the session data
            unset($_SESSION['quotation_data']);

            // Redirect to the offers page
            echo json_encode(['success' => true, 'redirect' => "/offers/$uid"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

    public function storeQuotationData()
    {
        // Store the quotation data in the session
        $data = json_decode(file_get_contents('php://input'), true);
        $_SESSION['quotation_data'] = [
            'birth' => $data['birth'],
            'age' => $data['age'],
            'duration' => $data['duration'],
            'tel' => preg_replace('/\s+/', '', $data['tel']), // Remove spaces
        ];

        echo json_encode(['success' => true]);
    }
}
