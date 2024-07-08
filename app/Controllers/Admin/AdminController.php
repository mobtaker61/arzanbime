<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use Core\Controller;
use Core\Middleware;


class AdminController extends Controller {
    public function __construct() {
        parent::__construct();
        Middleware::auth();   // Ensure user is authenticated
        Middleware::admin();  // Ensure user is admin
    }

    public function dashboard() {
        $postModel = new Post();
        $posts = $postModel->getAllPosts(5,1);

        $this->view('admin/dashboard', [
            'user' => $_SESSION['user_data'],
            'posts' => $posts,
            'pagetitle' => 'داشبورد ادمین'
        ], 'admin');
    }
}
