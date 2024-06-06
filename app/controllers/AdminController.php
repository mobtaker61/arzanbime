<?php
class AdminController extends Controller {
    public function __construct() {
        Middleware::auth();   // Ensure user is authenticated
        Middleware::admin();  // Ensure user is admin
    }

    public function index() {
        $postModel = new Post();
        $posts = $postModel->getAllPosts();
        $this->view('admin/dashboard', ['posts' => $posts], 'admin');
    }
}
