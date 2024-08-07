<?php

namespace App\Controllers\Admin;

use Core\Middleware;
use App\Models\User;
use App\Models\Profile;
use Core\Controller;
use App\Models\UserLevel;

class AgentController extends Controller
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
        $limit = $_GET['limit'] ?? 25;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $agents = $userModel->getUsersByRole('agent', $search, $limit, $offset);
        $totalAgents = $userModel->getUserCountByRole('agent', $search);
        $userLevels = $userLevelModel->getAllUserLevels();

        // اضافه کردن بالانس به اطلاعات یوزرها
        foreach ($agents as &$user) {
            $user['balance'] = $userModel->getUserBalance($user['id']);
        }

        $this->view('admin/agents/index', [
            'agents' => $agents,
            'totalAgents' => $totalAgents,
            'limit' => $limit,
            'page' => $page,
            'search' => $search,
            'userLevels' => $userLevels,
            'pagetitle' => 'مدیریت نمایندگان'
        ], 'admin');
    }

    public function store()
    {
        $userData = [
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role' => $_POST['role'],
            'user_level_id' => $_POST['user_level_id'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        $profileData = [
            'profile_image' => $_POST['profile_image'],
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'birth_date' => $_POST['birth_date'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'is_verified' => $_POST['isVerified']
        ];

        $userModel = new User();
        $profileModel = new Profile();

        $userId = $userModel->register($userData);
        $profileData['user_id'] = $userId;
        $profileModel->createProfile($profileData);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Agent created successfully.']);
    }

    public function edit($id)
    {
        $userModel = new User();
        $profileModel = new Profile();
        $userLevelModel = new UserLevel();

        $user = $userModel->getUserById($id);
        $profile = $profileModel->getProfileByUserId($id);
        $userLevels = $userLevelModel->getAllUserLevels();

        $user = array_merge($user, $profile);

        header('Content-Type: application/json');
        echo json_encode(['user' => $user, 'userLevels' => $userLevels]);
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
        echo json_encode(['success' => true, 'message' => 'Agent updated successfully.']);
    }

    public function delete($id)
    {
        $userModel = new User();
        $profileModel = new Profile();

        $profileModel->deleteProfile($id);
        $userModel->deleteUser($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Agent deleted successfully.']);
    }
}
