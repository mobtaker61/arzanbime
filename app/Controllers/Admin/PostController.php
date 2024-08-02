<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\PostType;
use Core\Controller;

class PostController extends Controller
{
    public function index()
    {
        $postModel = new Post();
        $postTypeModel = new PostType();

        $postTypes = $postTypeModel->getAllPostTypes();
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $posts = $postModel->getAllPosts($limit, $offset);
        $totalPosts = $postModel->getPostCount();

        if ($this->isAjax()) {
            echo json_encode([
                'posts' => $posts,
                'totalPosts' => $totalPosts,
                'limit' => $limit,
                'page' => $page,
            ]);
        } else {
            $this->view('admin/posts/index', [
                'postTypes' => $postTypes,
                'posts' => $posts,
                'totalPosts' => $totalPosts,
                'limit' => $limit,
                'page' => $page,
                'pagetitle' => 'محتواها'
            ], 'admin');
        }
    }

    public function create()
    {
        $postTypeModel = new PostType();
        $postTypes = $postTypeModel->getAllPostTypes();
        $this->view('admin/posts/create', [
            'postTypes' => $postTypes,
            'pagetitle' => 'محتوای جدید'
        ], 'admin');
    }

    public function store()
    {
        $data = [
            'post_type' => $_POST['post_type'],
            'title' => $_POST['title'],
            'caption' => $_POST['caption'],
            'full_body' => $_POST['full_body'],
            'image' => '',
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];

        if ($_FILES['image']['name']) {
            $data['image'] = $this->uploadImage($_FILES['image']);
        }

        $postModel = new Post();
        $postModel->createPost($data);
        header('Location: /admin/posts');
    }

    public function edit($id)
    {
        $postModel = new Post();
        $post = $postModel->getPostById($id);

        $postTypeModel = new PostType();
        $postTypes = $postTypeModel->getAllPostTypes();

        $this->view('admin/posts/edit', [
            'post' => $post, 'postTypes' => $postTypes,
            'pagetitle' => 'ویرایش محتوا'
        ], 'admin');
    }

    public function update($id)
    {
        $data = [
            'post_type' => $_POST['post_type'],
            'title' => $_POST['title'],
            'caption' => $_POST['caption'],
            'full_body' => $_POST['full_body'],
            'image' => '',
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];

        if (!empty($_FILES['image']['name'])) {
            $data['image'] = $this->uploadImage($_FILES['image']);
        } else {
            $postModel = new Post();
            $post = $postModel->getPostById($id);
            $data['image'] = $post['image'];
        }

        $postModel = new Post();
        $postModel->updatePost($id, $data);
        header('Location: /admin/posts');
    }

    public function delete($id)
    {
        $postModel = new Post();
        $postModel->deletePost($id);
        header('Location: /admin/posts');
    }

    public function getByPostType($type)
    {
        $postModel = new Post();
        $postTypeModel = new PostType();

        $postTypes = $postTypeModel->getAllPostTypes();
        $postType = $postTypeModel->getPostTypeBySlug($type);

        if (!$postType) {
            http_response_code(404);
            echo "Post type not found";
            return;
        }

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $posts = $postModel->getPostsByType($postType['id'], $limit, $offset);
        $totalPosts = $postModel->getPostCountByType($postType['id']);

        echo json_encode([
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'limit' => $limit,
            'page' => $page,
            'type' => $type
        ]);
    }

    private function uploadImage($file)
    {
        $targetDir = "public/uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }

        if (file_exists($targetFile)) {
            die("Sorry, file already exists.");
        }

        if ($file["size"] > 5000000) {
            die("Sorry, your file is too large.");
        }

        if ($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return "/" . $targetFile;
        } else {
            die("Sorry, there was an error uploading your file.");
        }
    }

    private function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
