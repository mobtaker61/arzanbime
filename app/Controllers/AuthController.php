<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\Quotation;
use App\Models\User;
use App\Models\UserLevel;
use Core\Controller;
use Core\Security;
use Core\View;
use Core\IMVerify;
use Exception;

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
        // Generate a CSRF token for the form
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['csrf_token'] = Security::generateCSRFToken();
        
        View::render('public/auth/login', [
            'pagetitle' => 'Login',
            'csrf_token' => $_SESSION['csrf_token']
        ], 'public');
    }

    public function login()
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Debugging information
        $debugInfo = [];
        $debugInfo[] = "Session Status: " . session_status();
        $debugInfo[] = "Session ID: " . session_id();
        $debugInfo[] = "Request Method: " . $_SERVER['REQUEST_METHOD'];
        
        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // If not a POST request, redirect to login form
            header('Location: /login');
            exit();
        }
        
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || 
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $error = "CSRF token validation failed. Please try again.";
            $debugInfo[] = "CSRF Validation Failed";
            $debugInfo[] = "POST Token: " . ($_POST['csrf_token'] ?? 'Not set');
            $debugInfo[] = "Session Token: " . ($_SESSION['csrf_token'] ?? 'Not set');
            
            // Generate new token for next attempt
            $_SESSION['csrf_token'] = Security::generateCSRFToken();
            
            View::render('public/auth/login', [
                'error' => $error,
                'debugInfo' => $debugInfo,
                'pagetitle' => 'ورود کاربر',
                'csrf_token' => $_SESSION['csrf_token']
            ], 'public');
            return;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $debugInfo[] = "Login attempt for username: " . $username;

        // Validate input
        if (empty($username) || empty($password)) {
            $error = "نام کاربری و رمز عبور الزامی است";
            $debugInfo[] = "Empty username or password";
            
            $_SESSION['csrf_token'] = Security::generateCSRFToken();
            
            View::render('public/auth/login', [
                'error' => $error,
                'debugInfo' => $debugInfo,
                'pagetitle' => 'ورود کاربر',
                'csrf_token' => $_SESSION['csrf_token']
            ], 'public');
            return;
        }

        $user = new User();
        $loginResult = $user->login($username, $password);
        $debugInfo = array_merge($debugInfo, $user->getDebugInfo());
        
        if ($loginResult === true) {
            $debugInfo[] = "Login successful";
            $debugInfo[] = "Session user_id: " . ($_SESSION['user_id'] ?? 'Not set');
            $debugInfo[] = "Session user_role: " . ($_SESSION['user_role'] ?? 'Not set');
            
            // Get the role from session
            $role = $_SESSION['user_role'] ?? User::ROLE_USER;
            $redirectUrl = '/' . $role;
            
            $debugInfo[] = "Redirecting to: " . $redirectUrl;
            
            // Log successful login
            error_log("User {$username} logged in successfully. Role: {$role}");
            
            // Force direct navigation with JavaScript
            echo "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Redirecting...</title>
                <meta http-equiv='refresh' content='2;url={$redirectUrl}'>
            </head>
            <body>
                <h3>Login successful! Redirecting to dashboard...</h3>
                <p>If you are not redirected automatically, <a href='{$redirectUrl}'>click here</a>.</p>
                <script>
                    console.log('Login successful, redirecting to: {$redirectUrl}');
                    setTimeout(function() {
                        window.location.href = '{$redirectUrl}';
                    }, 2000);
                </script>
                <div style='display:none;'>Debug info: " . implode('<br>', $debugInfo) . "</div>
            </body>
            </html>";
            exit();
        } else {
            $error = "نام کاربری یا رمز عبور اشتباه است";
            $debugInfo[] = "Login failed";
            
            // Generate new token for next attempt
            $_SESSION['csrf_token'] = Security::generateCSRFToken();
            
            View::render('public/auth/login', [
                'error' => $error,
                'debugInfo' => $debugInfo,
                'pagetitle' => 'ورود کاربر',
                'csrf_token' => $_SESSION['csrf_token']
            ], 'public');
        }
    }

    public function showRegisterForm()
    {
        // Generate a CSRF token for the form
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['csrf_token'] = Security::generateCSRFToken();
        
        // Get user levels for the dropdown
        $userLevelModel = new UserLevel();
        $userLevels = $userLevelModel->getAllUserLevels();
        
        View::render('public/auth/register', [
            'pagetitle' => 'Register',
            'csrf_token' => $_SESSION['csrf_token'],
            'userLevels' => $userLevels
        ], 'public');
    }

    public function register()
    {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            // Generate new token for next attempt
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['csrf_token'] = Security::generateCSRFToken();
            
            View::render('public/auth/register', [
                'error' => 'CSRF token validation failed. Please try again.',
                'pagetitle' => 'ثبت نام کاربر',
                'csrf_token' => $_SESSION['csrf_token']
            ], 'public');
            return;
        }

        try {
            $userData = $this->getUserDataFromRequest();

            // Validate required fields
            $requiredFields = ['username', 'password', 'name', 'surname', 'tel', 'email'];
            foreach ($requiredFields as $field) {
                if (empty($userData[$field])) {
                    throw new Exception("Field {$field} is required");
                }
            }

            // Password validation
            if (strlen($userData['password']) < 8) {
                throw new Exception("Password must be at least 8 characters long");
            }

            // Hash password
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            
            // Set default values
            $userData['user_level_id'] = $userData['user_level_id'] ?? 1;
            $userData['is_active'] = 1;
            $userData['role'] = $userData['role'] ?? User::ROLE_USER;

            $user = new User();
            
            // Check if username, email, or phone already exists
            if ($user->isUsernameOrTelExists($userData['username'], $userData['tel'], $userData['email'])) {
                throw new Exception("نام کاربری، ایمیل یا تلفن قبلا ثبت شده است");
            }

            // Register the user
            $userId = $user->register($userData);
            if (!$userId) {
                throw new Exception("Failed to create user account");
            }

            // Create user profile
            $this->createUserProfile($userId, $userData);

            // Redirect to login page
            header('Location: /login');
            exit();
        } catch (Exception $e) {
            // In case of error, regenerate CSRF token and show error message
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['csrf_token'] = Security::generateCSRFToken();
            
            $userLevelModel = new UserLevel();
            $userLevels = $userLevelModel->getAllUserLevels();
            
            View::render('public/auth/register', [
                'error' => $e->getMessage(),
                'pagetitle' => 'ثبت نام کاربر',
                'csrf_token' => $_SESSION['csrf_token'],
                'userLevels' => $userLevels
            ], 'public');
        }
    }

    public function logout()
    {
        $user = new User();
        $user->logout();
        header('Location: /');
        exit();
    }

    /**
     * Extract user data from the request
     * 
     * @return array User data
     */
    private function getUserDataFromRequest(): array
    {
        return [
            'username' => trim($_POST['username'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'name' => trim($_POST['name'] ?? ''),
            'surname' => trim($_POST['surname'] ?? ''),
            'tel' => trim($_POST['tel'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'birth_date' => $_POST['birth'] ?? null,
            'role' => $_POST['role'] ?? User::ROLE_USER,
            'user_level_id' => (int)($_POST['user_level_id'] ?? 1),
            'fcm_token' => $_POST['fcm_token'] ?? '' // Add FCM token from form or set empty default
        ];
    }

    /**
     * Create a profile for a user
     * 
     * @param int $userId User ID
     * @param array $data User data
     * @return bool Success status
     */
    private function createUserProfile(int $userId, array $data): bool
    {
        $profileData = [
            'user_id' => $userId,
            'profile_image' => '',
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'phone' => $data['tel'],
            'is_verified' => 0
        ];

        $profile = new Profile();
        return $profile->createProfile($profileData);
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

        $_SESSION['quotation_data'] = [
            'birth_date' => $data['birth'],
            'age' => $data['age'],
            'duration' => $data['duration'],
            'tel' => $tel,
            'role' => 'user',            
            'user_level_id' => 2,
            'user_id' => null,
            'status' => 'NEW'
        ];

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
            $quotationModel = new Quotation();
            $quotationData = $_SESSION['quotation_data'];
            $quotationData['user_id'] = $quotationData['user_id'] ?? $this->createUserFromQuotationData($quotationData);

            $uid = $quotationModel->createQuotation($quotationData);

            $this->notify('استعلام جدید در: ' . PHP_EOL . json_encode($_SESSION['quotation_data']) . PHP_EOL . PHP_EOL . 'https://arzanbime.com/offers/' . $uid, ['telegram']);
            $this->imVerify->send($quotationData['tel'], 'نتیجه استعلام شما در آدرس ' . 'https://arzanbime.com/offers/' . $uid);

            unset($_SESSION['quotation_data']);
            echo json_encode(['success' => true, 'redirect' => "/offers/$uid"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

    public function storeQuotationData()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $_SESSION['quotation_data'] = [
            'birth' => $data['birth'],
            'age' => $data['age'],
            'duration' => $data['duration'],
            //            'tel' => preg_replace('/\s+/', '', $data['tel']),
            'user_id' => $data['user_id'] ?? $_SESSION['user_id'],
        ];

        $quotationModel = new Quotation();
        $quotationData = $_SESSION['quotation_data'];

        $uid = $quotationModel->createQuotation($quotationData);

        $profile = new Profile();
        $tel = $profile->getProfileByUserId($_SESSION['user_id']);

        $this->notify('استعلام جدید در: ' . PHP_EOL . json_encode($_SESSION['quotation_data']) . PHP_EOL . PHP_EOL . 'https://arzanbime.com/offers/' . $uid, ['telegram']);
        $this->imVerify->send($tel['phone'], 'نتیجه استعلام شما در آدرس ' . 'https://arzanbime.com/offers/' . $uid);

        echo json_encode(['success' => true, 'redirect' => "/offers/$uid"]);
    }

    public function checkTel()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $tel = preg_replace('/\s+/', '', $data['tel']);

        $profileModel = new Profile();
        $profile = $profileModel->getProfileByPhone($tel);

        if ($profile) {
            $_SESSION['user_id'] = $profile[0]['user_id'];
            $_SESSION['user_role'] = 'user';
            echo json_encode(['exists' => true, 'user_id' => $profile[0]['user_id']]);
        } else {
            echo json_encode(['exists' => false]);
        }
    }

    private function createUserFromQuotationData($quotationData)
    {
        $user = new User();
        $profile = new Profile();

        $username = $quotationData['tel'];
        $password = password_hash($username, PASSWORD_BCRYPT);

        $userId = $user->register([
            'username' => $username,
            'password' => $password,
            'role' => 'user',
            'user_level_id' => 2,//بعدا باید از جدول تنطیمات خوانده شود
            'is_active' => 1
        ]);

        $profileData = [
            'user_id' => $userId,
            'profile_image' => '',
            'name' => '',
            'surname' => '',
            'birth_date' => $quotationData['birth_date'],
            'email' => null,
            'phone' => $quotationData['tel'],
            'is_verified' => 1
        ];

        $profile->createProfile($profileData);

        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = 'user';

        return $userId;
    }
}
