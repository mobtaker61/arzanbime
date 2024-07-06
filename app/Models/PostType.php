<?php

namespace App\Models;

use Core\Model;
use FFI\Exception;

class PostType extends Model
{
    public function getPostTypeBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM post_type WHERE slug = ? LIMIT 1");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    public function getAllPostTypes() {
        $result = $this->db->query("SELECT * FROM post_type");
        return $this->fetchAssoc($result);
    }

    public function createPostType($data) {
        $stmt = $this->db->prepare("INSERT INTO post_type (title, slug, description, icon, color, sort, is_menu) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssis', $data['title'], $data['slug'], $data['description'], $data['icon'], $data['color'], $data['sort'], $data['is_menu']);
        $stmt->execute();
        $stmt->close();
    }

    public function updatePostType($id, $data) {
        $stmt = $this->db->prepare("UPDATE post_type SET title = ?, slug = ?, description = ?, icon = ?, color = ?, sort = ?, is_menu = ? WHERE id = ?");
        $stmt->bind_param('sssssiis', $data['title'], $data['slug'], $data['description'], $data['icon'], $data['color'], $data['sort'], $data['is_menu'], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deletePostType($id) {
        $stmt = $this->db->prepare("DELETE FROM post_type WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }
  
    private function fetchAssoc($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}