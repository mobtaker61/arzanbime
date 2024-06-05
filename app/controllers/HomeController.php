<?php
class HomeController extends Controller {
    public function __construct() {
        // Public access, no middleware
    }

    public function index() {
        $postModel = new Post();
        $posts = $postModel->getAllPosts();
        $this->view('user/home', ['posts' => $posts]);
    }
}
