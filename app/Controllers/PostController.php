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

        // Calculate reading time
        $word_count = str_word_count(strip_tags($post['full_body']));
        $reading_time = ceil($word_count / 200);

        // Generate keywords from content
        $content_words = strip_tags($post['full_body']);
        $words = explode(' ', $content_words);
        $common_words = ['در', 'به', 'از', 'که', 'این', 'با', 'برای', 'یا', 'و', 'را', 'است', 'شود', 'می', 'های', 'های', 'آن', 'آنها', 'خود', 'خودش', 'خودشان'];
        $keywords_array = array_diff($words, $common_words);
        $keywords_array = array_slice($keywords_array, 0, 10);
        $keywords = $post['title'] . ', ' . $post['postType'] . ', بیمه, ترکیه, اقامت, ' . implode(', ', $keywords_array);

        // Generate SEO variables
        $seo_vars = [
            'pagetitle' => $post['title'] . ' - ' . $post['postType'] . ' | ارزان بیمه',
            'description' => !empty($post['caption']) ? $post['caption'] : substr(strip_tags($post['full_body']), 0, 160),
            'keywords' => $keywords,
            'og_title' => $post['title'],
            'og_description' => !empty($post['caption']) ? $post['caption'] : substr(strip_tags($post['full_body']), 0, 160),
            'og_image' => !empty($post['image']) ? 'https://' . $_SERVER['HTTP_HOST'] . $post['image'] : 'https://' . $_SERVER['HTTP_HOST'] . '/public/assets/default-image.webp',
            'og_url' => 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            'twitter_card' => 'summary_large_image',
            'twitter_site' => '@arzanbime',
            'twitter_creator' => '@arzanbime',
            'reading_time' => $reading_time,
            'word_count' => $word_count,
            'published_date' => $post['created_at'] ?? date('Y-m-d'),
            'modified_date' => $post['updated_at'] ?? $post['created_at'] ?? date('Y-m-d')
        ];

        view::render('public/posts/show', array_merge([
            'post' => $post,
            'latestGuides' => $latestGuides,
            'latestNotices' => $latestNotices,
            'latestFaqs' => $latestFaqs
        ], $seo_vars));
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
