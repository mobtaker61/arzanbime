<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\PostType;
use Core\View;
use Exception;

class PostController extends Controller
{
    public function index($postTypeSlug = null)
    {
        try {
            $postModel = new Post();
            $postTypeModel = new PostType();

            $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $offset = ($page - 1) * $limit;
            $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'DESC';

            $postType = null;
            $viewPath = 'public/posts/index';
            if ($postTypeSlug) {
                $postType = $postTypeModel->getPostTypeBySlug($postTypeSlug);
                if ($postType) {
                    $posts = $postModel->getPostsByType($postType['id'], $limit, $offset, $order);
                    $totalPosts = $postModel->getPostCountByType($postType['id']);
                    $viewPath = 'public/posts/' . $postTypeSlug;
                } else {
                    $posts = [];
                    $totalPosts = 0;
                }
            } else {
                $posts = $postModel->getAllPosts($limit, $offset);
                $totalPosts = $postModel->getPostCount();
            }

            // Fetch latest posts for sidebar
            $latestGuides = $postModel->getPostsByType(1, 5);
            $latestNotices = $postModel->getPostsByType(2, 5);
            $latestFaqs = $postModel->getPostsByType(3, 5);

            $postTypes = $postTypeModel->getAllPostTypes();

            View::render($viewPath, [
                'postTypes' => $postTypes,
                'posts' => $posts,
                'totalPosts' => $totalPosts,
                'limit' => $limit,
                'page' => $page,
                'order' => $order,
                'postType' => $postTypeSlug,
                'latestGuides' => $latestGuides,
                'latestNotices' => $latestNotices,
                'latestFaqs' => $latestFaqs,
                'pagetitle' => $postType['title'] . ' ها'
            ]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function show($id)
    {
        $postModel = new Post();
        $post = $postModel->getPostById($id);
        // Fetch latest posts for sidebar
        $latestGuides = $postModel->getPostsByType(1, 5);
        $latestNotices = $postModel->getPostsByType(2, 5);
        $latestFaqs = $postModel->getPostsByType(3, 5);

        if (!$post) {
            http_response_code(404);
            echo "Post not found";
            return;
        }

        view::render('public/posts/show', [
            'post' => $post,
            'latestGuides' => $latestGuides,
            'latestNotices' => $latestNotices,
            'latestFaqs' => $latestFaqs,
            'pagetitle' => $post['title']
        ]);
    }

    public function getByPostType($type)
    {
        $postModel = new Post();
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'DESC';

        $posts = $postModel->getPostsByType($type, $limit, $offset, $order);
        $totalPosts = $postModel->getPostCountByType($type);

        View::render('public/posts/index', [
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'limit' => $limit,
            'page' => $page,
            'order' => $order,
            'type' => $type,
            'pagetitle' => 'Posts by Type: ' . $type
        ]);
    }
}
