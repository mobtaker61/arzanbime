<?php

namespace App\Controllers\Admin;

use App\Models\UserLevel;
use Core\Controller;
use Core\Middleware;
use Core\View;

class UserLevelController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Middleware::auth();
        Middleware::admin();
    }

    public function index()
    {
        $userLevelModel = new UserLevel();
        $userLevels = $userLevelModel->getAllUserLevels();
        
        View::render('admin/user_levels/index', [
            'userLevels' => $userLevels,
            'pagetitle' => 'مدیریت سطوح کاربری'
        ], 'admin');
    }

    public function create()
    {
        View::render('admin/user_levels/create', [
            'pagetitle' => 'افزودن سطح کاربری جدید'
        ], 'admin');
    }

    public function edit($id)
    {
        $userLevelModel = new UserLevel();
        $userLevel = $userLevelModel->getUserLevelById($id);
        
        if (!$userLevel) {
            $this->redirect('/admin/user_levels');
            return;
        }
        
        View::render('admin/user_levels/edit', [
            'userLevel' => $userLevel,
            'pagetitle' => 'ویرایش سطح کاربری'
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
