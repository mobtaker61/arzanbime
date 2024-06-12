<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\PostType;
use Core\Controller;

class PostController extends Controller {
    public function index() {
        $postModel = new Post();
        $postTypeModel = new PostType();

        $postTypes = $postTypeModel->getAllPostTypes();
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        
        $posts = $postModel->getAllPosts($limit, $offset);
        $totalPosts = $postModel->getPostCount();

        $this->view('public/posts/index', [
            'postTypes' => $postTypes,
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'limit' => $limit,
            'page' => $page,
            'pagetitle' => 'محتواها'
        ]);
    }

    public function show($id) {
        $postModel = new Post();
        $post = $postModel->getPostById($id);

        $this->view('public/posts/show', ['post' => $post]);
    }

    public function getByPostType($type) {
        $postModel = new Post();
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        
        $posts = $postModel->getPostsByType($type, $limit, $offset);
        $totalPosts = $postModel->getPostCountByType($type);

        $this->view('public/posts/index', [
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'limit' => $limit,
            'page' => $page,
            'type' => $type,
            'pagetitle' => 'Posts by Type: ' . $type
        ]);
    }
}
