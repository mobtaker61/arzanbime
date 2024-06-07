<?php
class HomeController extends Controller {
    public function index() {
        $postModel = new Post();
        $posts = $postModel->getAllPosts(5,1);
        $this->view('user/home', ['posts' => $posts], 'user');
    }
}
