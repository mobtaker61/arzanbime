<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use App\Models\PostType;

class RssController extends Controller {
    public function index() {
        header("Content-Type: application/rss+xml; charset=utf-8");

        $postModel = new Post();
        $posts = $postModel->getAllPosts();

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<?xml-stylesheet type="text/xsl" href="/rss.xsl"?>';  // Include the XSLT stylesheet reference
        echo '<rss version="2.0"><channel>';
        echo '<title>All Posts</title>';
        echo '<link>https://www.arzanbime.com/rss</link>';
        echo '<description>Latest posts from Arzan Bimeh</description>';

        foreach ($posts as $post) {
            echo '<item>';
            echo '<title>' . htmlspecialchars($post['title']) . '</title>';
            echo '<link>https://www.arzanbime.com/post/' . $post['id'] . '</link>';
            echo '<description>' . htmlspecialchars($post['caption']) . '</description>';
            echo '<pubDate>' . date(DATE_RSS, strtotime($post['created_at'])) . '</pubDate>';
            echo '</item>';
        }

        echo '</channel></rss>';
    }

    public function byPostType($postType) {
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
        echo '<?xml-stylesheet type="text/xsl" href="/rss.xsl"?>';  // Include the XSLT stylesheet reference
        echo '<rss version="2.0"><channel>';
        echo '<title>' . $type['name'] . ' Posts</title>';
        echo '<link>https://www.arzanbime.com/rss/' . $postType . '</link>';
        echo '<description>Latest ' . $type['name'] . ' posts from Arzan Bimeh</description>';

        foreach ($posts as $post) {
            echo '<item>';
            echo '<title>' . htmlspecialchars($post['title']) . '</title>';
            echo '<link>https://www.arzanbime.com/post/' . $post['id'] . '</link>';
            echo '<description>' . htmlspecialchars($post['caption']) . '</description>';
            echo '<pubDate>' . date(DATE_RSS, strtotime($post['created_at'])) . '</pubDate>';
            echo '</item>';
        }

        echo '</channel></rss>';
    }
}
