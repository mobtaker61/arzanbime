<?php
namespace App\Models;

use Core\Model;
class Post extends Model {
    public function getAllPosts($limit, $offset) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE is_active = 1 LIMIT ? OFFSET ?");
        $stmt->bind_param('ii', $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPostCount() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM post WHERE is_active = 1");
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getPostsByType($type, $limit, $offset) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post_type = ? AND is_active = 1 ORDER BY id DESC LIMIT ? OFFSET ?");
        $stmt->bind_param('iii', $type, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPostsByPostType($postType, $page, $limit) {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post_type = ? ORDER BY id DESC LIMIT ? OFFSET ?");
        $stmt->bind_param('iii', $postType, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPostCountByType($type) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM post WHERE post_type = ? AND is_active = 1");
        $stmt->bind_param('i', $type);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function createPost($data) {
        $stmt = $this->db->prepare("INSERT INTO post (post_type, title, caption, full_body, image, is_active) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issssi', $data['post_type'], $data['title'], $data['caption'], $data['full_body'], $data['image'], $data['is_active']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updatePost($id, $data) {
        $stmt = $this->db->prepare("UPDATE post SET post_type = ?, title = ?, caption = ?, full_body = ?, image = ?, is_active = ? WHERE id = ?");
        $stmt->bind_param('issssii', $data['post_type'], $data['title'], $data['caption'], $data['full_body'], $data['image'], $data['is_active'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM post WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    private function fetchAssoc($stmt) {
        $stmt->store_result();
        $variables = [];
        $data = [];
        $meta = $stmt->result_metadata();
        while ($field = $meta->fetch_field()) {
            $variables[] = &$data[$field->name];
        }
        call_user_func_array([$stmt, 'bind_result'], $variables);
        $results = [];
        while ($stmt->fetch()) {
            $row = [];
            foreach ($data as $key => $val) {
                $row[$key] = $val;
            }
            $results[] = $row;
        }
        return $results;
    }
}
