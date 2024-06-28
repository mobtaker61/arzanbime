<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Company;
use App\Models\ContactSubmission;
use Core\Security;
use Core\View;

class ContactController extends Controller {
    public function index() {
        $companyModel = new Company();
        $companies = $companyModel->getAllCompanies();

        View::render('public/contact', [
            'pagetitle' => 'تماس با ما',
            'description' => 'صفحه تماس با ما',
            'keywords' => 'تماس, ارزان بیمه',
            'companies' => $companies
        ], 'public');
    }

    public function submit() {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $cell = $_POST['cell'];
        $message = $_POST['message'];

        $contactSubmission = new ContactSubmission();
        $result = $contactSubmission->saveSubmission($name, $email, $cell, $message);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'پیام شما با موفقیت ارسال شد.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ارسال پیام با خطا مواجه شد.']);
        }
    }

    public function updateStatus() {
        if (!Security::verifyCSRFToken($_POST['csrf_token'])) {
            die('CSRF token validation failed');
        }

        $id = $_POST['id'];
        $status = $_POST['status'];

        $contactSubmission = new ContactSubmission();
        $result = $contactSubmission->updateStatus($id, $status);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'وضعیت با موفقیت به‌روزرسانی شد.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'به‌روزرسانی وضعیت با خطا مواجه شد.']);
        }
    }

    public function listSubmissions() {
        $contactSubmission = new ContactSubmission();
        $submissions = $contactSubmission->getAllSubmissions();

        View::render('admin/contact_submissions', [
            'submissions' => $submissions,
            'pagetitle' => 'لیست پیام‌ها'
        ], 'admin');
    }
}
