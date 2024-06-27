<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;

class SitemapController extends Controller {
    public function index() {
        header("Content-Type: application/xml; charset=utf-8");

        $postModel = new Post();
        $posts = $postModel->getAllPosts();

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        echo '<url>';
        echo '<loc>https://www.arzanbime.com/</loc>';
        echo '<changefreq>daily</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';

        foreach ($posts as $post) {
            echo '<url>';
            echo '<loc>https://www.arzanbime.com/post/' . $post['id'] . '</loc>';
            echo '<changefreq>weekly</changefreq>';
            echo '<priority>0.9</priority>';
            echo '</url>';
        }

        echo '</urlset>';
    }
}
