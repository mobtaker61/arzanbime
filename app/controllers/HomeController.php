<?php
class HomeController extends Controller
{
    public function index()
    {
        $postModel = new Post();
        $posts = $postModel->getAllPosts(5, 1);
        $guides = $postModel->getPostsByPostType(1, 1, 15);
        $notices = $postModel->getPostsByPostType(2, 1, 10);
        $faqs = $postModel->getPostsByPostType(3, 1, 10);
        view::render('public/home/index', ['posts' => $posts, 'guides' => $guides, 'notices' => $notices, 'faqs' => $faqs], 'public');
    }
}
