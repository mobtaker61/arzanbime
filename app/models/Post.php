<?php
class Post extends Model {
    public function getAllPosts() {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE is_active = 1");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createPost($data) {
        $stmt = $this->db->prepare("INSERT INTO post (post_type, title, caption, full_body, image, is_active) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issssi', $data['post_type'], $data['title'], $data['caption'], $data['full_body'], $data['image'], $data['is_active']);
        return $stmt->execute();
    }

    public function updatePost($id, $data) {
        $stmt = $this->db->prepare("UPDATE post SET post_type = ?, title = ?, caption = ?, full_body = ?, image = ?, is_active = ? WHERE id = ?");
        $stmt->bind_param('issssii', $data['post_type'], $data['title'], $data['caption'], $data['full_body'], $data['image'], $data['is_active'], $id);
        return $stmt->execute();
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM post WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
