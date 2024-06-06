<?php
class HomeController extends Controller {
    public function index() {
        $postModel = new Post();
        $posts = $postModel->getAllPosts();
        $this->view('user/home', ['posts' => $posts], 'user');
    }
}
