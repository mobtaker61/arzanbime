<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\PostType;

class RssController extends Controller
{
    public function index()
    {
        header("Content-Type: application/rss+xml; charset=utf-8");

        $postModel = new Post();
        $posts = $postModel->getAllPosts();

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">';
        echo '<channel>';
        echo '<title>وبلاگ ارزان بیمه</title>';
        echo '<link>https://www.arzanbime.com/rss/</link>';
        echo '<description>ما بیمه سلامت و اجازه اقامت را به صورت آنلاین و سریع در سه مرحله ساده ارائه می دهی</description>';
        echo '<language>fa</language>';        

        foreach ($posts as $post) {
            echo '<item>';
            echo '<guid isPermaLink="false">'. $post['id'] .'</guid>';
            echo '<title>' . htmlspecialchars($post['title']) . '</title>';
            echo '<link>https://www.arzanbime.com/post/' . $post['id'] . '</link>';
            echo '<author>Administrator</author>';
            echo '<category>'. $post['post_type'] .'</category>';
            echo '<description>' . htmlspecialchars($post['caption']) . '</description>';
            echo '<content:encoded>' . htmlspecialchars($post['full_body']) . '</content:encoded>';
            echo '<pubDate>' . date(DATE_RSS, strtotime($post['created_at'])) . '</pubDate>';
            echo '</item>';
        }

        echo '</channel></rss>';
    }

    public function byPostType($postType)
    {
        header("Content-Type: application/rss+xml; charset=utf-8");

        $postModel = new Post();
        $postTypeModel = new PostType();

        $type = $postTypeModel->getPostTypeBySlug($postType);
        if (!$type) {
            http_response_code(404);
            echo "Post type not found";
            return;
        }

        $posts = $postModel->getPostsByType($type['id']);

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">';
        echo '<channel>';
        echo '<title>' . $type['title'] . ' Posts</title>';
        echo '<link>https://www.arzanbime.com/rss/' . $postType . '</link>';
        echo '<description>Latest ' . $type['title'] . ' posts from Arzan Bimeh</description>';
        echo '<language>fa</language>';

        foreach ($posts as $post) {
            echo '<item>';
            echo '<guid isPermaLink="false">'. $post['id'] .'</guid>';
            echo '<title>' . htmlspecialchars($post['title']) . '</title>';
            echo '<link>https://www.arzanbime.com/post/' . $post['id'] . '</link>';
            echo '<author>Administrator</author>';
            echo '<category>'. $type['title'] .'</category>';
            echo '<description>' . htmlspecialchars($post['full_body']) . '</description>';
            echo '<pubDate>' . date(DATE_RSS, strtotime($post['created_at'])) . '</pubDate>';
            echo '</item>';
        }

        echo '</channel></rss>';
    }

    public function sitemap()
    {
        header("Content-Type: application/xml; charset=utf-8");

        $postModel = new Post();
        $posts = $postModel->getAllPosts();

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
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