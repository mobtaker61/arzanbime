<?php
class Post extends Model {
    public function getAllPosts() {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE is_active = 1");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getPostsByPostType($postType, $page, $limit) {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post_type = ? LIMIT ? OFFSET ?");
        $stmt->bind_param('iii', $postType, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function countPostsByPostType($postType) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM post WHERE post_type = ?");
        $stmt->bind_param('i', $postType);
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $stmt->close();
        return $total;
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
