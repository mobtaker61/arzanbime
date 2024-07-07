<?php

namespace App\Controllers\Admin;

use App\Models\UserLevel;
use Core\Controller;

class UserLevelController extends Controller
{
    public function index()
    {
        $userLevelModel = new UserLevel();
        $userLevels = $userLevelModel->getAllUserLevels();
        $this->view('admin/user_levels/index', [
            'userLevels' => $userLevels,
            'pagetitle' => 'مدیریت سطوح کاربران'
        ], 'admin');
    }

    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'color' => $_POST['color'],
            'min_value' => $_POST['min_value'],
            'max_value' => $_POST['max_value']
        ];

        $userLevelModel = new UserLevel();
        $result = $userLevelModel->createUserLevel($data);

        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    public function edit($id)
    {
        $userLevelModel = new UserLevel();
        $userLevel = $userLevelModel->getUserLevelById($id);

        header('Content-Type: application/json');
        echo json_encode($userLevel);
    }

    public function update($id)
    {
        $data = [
            'name' => $_POST['name'],
            'color' => $_POST['color'],
            'min_value' => $_POST['min_value'],
            'max_value' => $_POST['max_value']
        ];

        $userLevelModel = new UserLevel();
        $result = $userLevelModel->updateUserLevel($id, $data);

        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    public function delete($id)
    {
        $userLevelModel = new UserLevel();
        $result = $userLevelModel->deleteUserLevel($id);

        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}
