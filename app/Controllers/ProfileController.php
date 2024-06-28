<?php

namespace App\Controllers;

use App\Models\Profile;
use Core\Controller;
use Core\View;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = $_SESSION['user_id'];

        $profileModel = new Profile();
        $profile = $profileModel->getProfileByUserId($userId);

        if (!$profile) {
            View::render('user/profile/create', ['pagetitle' => 'ساخت پروفایل'], 'user');
        } else {
            View::render('user/profile/show', ['profile' => $profile, 'pagetitle' => 'پروفایل کاربری'], 'user');
        }
    }

    public function create()
    {
        View::render('user/profile/create', ['pagetitle' => 'ساخت پروفایل'], 'user');
    }

    public function store()
    {
        $errors = [];
    
        if (empty($_POST['name'])) {
            $errors[] = 'Name is required';
        }
        if (empty($_POST['surname'])) {
            $errors[] = 'Surname is required';
        }
        if (empty($_POST['birth_date'])) {
            $errors[] = 'Birthdate is required';
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }
        if (empty($_POST['phone']) || !preg_match('/^\+[1-9]\d{1,14}$/', $_POST['phone'])) {
            $errors[] = 'Invalid international phone number';
        }
    
        if (!empty($errors)) {
            View::render('user/profile/create', [
                'pagetitle' => 'Create Profile',
                'errors' => $errors
            ], 'user');
            return;
        }
    
        $data = [
            'user_id' => $_SESSION['user_id'],
            'profile_image' => '',
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'birth_date' => $_POST['birth_date'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'is_verified' => isset($_POST['is_verified']) ? 1 : 0
        ];
    
        $profileModel = new Profile();
        $profileModel->createProfile($data);
    
        header('Location: /user/profile');
        exit();
    }

    public function uploadImage()
    {
        $response = ['status' => 'error', 'message' => 'Image upload failed'];
    
        if (isset($_FILES['profile_image']['tmp_name'])) {
            $targetDir = 'public/uploads/profiles/';
            $imagePath = $targetDir . basename($_FILES['profile_image']['name']);
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $imagePath)) {
                $response = ['status' => 'success', 'imagePath' => '/' . $imagePath];
            }
        }
    
        echo json_encode($response);
    }    

    public function edit()
    {
        $userId = $_SESSION['user_id'];

        $profileModel = new Profile();
        $profile = $profileModel->getProfileByUserId($userId);

        View::render('user/profile/edit', ['profile' => $profile, 'pagetitle' => 'ویرایش پروفایل'], 'user');
    }

    public function update()
    {
        $userId = $_SESSION['user_id'];

        $data = [
            'user_id' => $userId,
            'profile_image' => $_POST['existing_image'],
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'birth_date' => $_POST['birth_date'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'is_verified' => isset($_POST['is_verified']) ? 1 : 0,
        ];

        $profileModel = new Profile();
        $profileModel->updateProfile($userId, $data);

        header('Location: /user/profile');
    }
}
