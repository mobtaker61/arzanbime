<?php

namespace App\Controllers\Admin;

use Core\View;
use Core\Middleware;
use App\Models\User;
use App\Models\Profile;
use App\Models\Transaction;
use Core\Controller;
use App\Models\UserLevel;
use App\Models\UserRole;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index()
    {
        $userModel = new User();
        $userLevelModel = new UserLevel();
        $search = $_GET['search'] ?? '';
        $limit = $_GET['limit'] ?? 10;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $users = $userModel->getUsersByRole('user', $search, $limit, $offset);
        $totalUsers = $userModel->getUserCountByRole('user', $search);
        $userLevels = $userLevelModel->getAllUserLevels();

        // اضافه کردن بالانس به اطلاعات یوزرها
        foreach ($users as &$user) {
            $user['balance'] = $userModel->getUserBalance($user['id']);
        }

        View::render('admin/users/index', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'limit' => $limit,
            'page' => $page,
            'search' => $search,
            'userLevels' => $userLevels,
            'pagetitle' => 'مدیریت کاربران'
        ], 'admin');
    }

    public function create()
    {
        $userRoleModel = new UserRole();
        $roles = $userRoleModel->getAllRoles();
        
        View::render('admin/users/create', [
            'roles' => $roles,
            'pagetitle' => 'افزودن کاربر جدید'
        ], 'admin');
    }

    public function store()
    {
        $pass = $_POST['password'] ?? $_POST['username'];
        $userData = [
            'username' => $_POST['username'],
            'password' => password_hash($pass, PASSWORD_BCRYPT),
            'role' => $_POST['role'] ?? 'user',
            'user_level_id' => $_POST['user_level_id'] ?? 2,
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        $profileData = [
            'profile_image' => $_POST['profile_image'] ?? null,
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'birth_date' => $_POST['birth_date'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
        ];

        $userModel = new User();
        $profileModel = new Profile();

        $userId = $userModel->register($userData);
        $profileData['user_id'] = $userId;
        $profileModel->createProfile($profileData);

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'User created successfully.',
            'user' => [
                'id' => $userId,
                'username' => $userData['username'],
                'name' => $profileData['name'],
                'surname' => $profileData['surname'],
                'birth_date' => $profileData['birth_date']  // Add birth_date to response
            ]
        ]);
    }

    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->getUserById($id);
        
        $userRoleModel = new UserRole();
        $roles = $userRoleModel->getAllRoles();
        
        if (!$user) {
            $this->redirect('/admin/users');
            return;
        }
        
        View::render('admin/users/edit', [
            'user' => $user,
            'roles' => $roles,
            'pagetitle' => 'ویرایش کاربر'
        ], 'admin');
    }

    public function update($id)
    {
        $userData = [
            'username' => $_POST['username'],
            'role' => $_POST['role'],
            'user_level_id' => $_POST['user_level_id'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        // If password is provided, hash it and add to userData
        if (!empty($_POST['password'])) {
            $userData['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        $profileData = [
            'profile_image' => $_POST['profile_image'],
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'birth_date' => $_POST['birth_date'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
        ];

        $userModel = new User();
        $profileModel = new Profile();

        $userModel->updateUser($id, $userData);
        $profileModel->updateProfile($id, $profileData);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
    }

    public function delete($id)
    {
        $userModel = new User();
        $profileModel = new Profile();

        $profileModel->deleteProfile($id);
        $userModel->deleteUser($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
    }

    public function getUserTransactions($userId, $limit = 200, $page = 1)
    {
        $offset = ($page - 1) * $limit;
        $transactionModel = new Transaction();
        $transactions = $transactionModel->getTransactionsByUserId($userId, $limit, $offset);
        $totalTransactions = $transactionModel->getTotalTransactions($userId);
        $sumDebitCredit = $transactionModel->getDebitCreditSum($userId);
        $balance = $sumDebitCredit['total_credit'] - $sumDebitCredit['total_debit'];

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions,
            'sumDebitCredit' => $sumDebitCredit,
            'balance' => $balance
        ]);
    }

    public function getFilteredTransactions($userId)
    {
        $transactionModel = new Transaction();
        $userBalance = $transactionModel->getUsersBalance($userId);

        $allTransactions = $transactionModel->getTransactionsByUserId($userId);
        $filteredTransactions = [];
        $totalDebit = 0;

        foreach ($allTransactions as $transaction) {
            if ($transaction['debit'] <> 0) {
                $filteredTransactions[] = $transaction;
                $totalDebit += $transaction['debit'];
            }
            if ($totalDebit >= abs($userBalance)) {
                break;
            }
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'transactions' => $filteredTransactions,
        ]);
    }
}
