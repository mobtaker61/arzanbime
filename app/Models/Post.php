<?php

namespace App\Models;

use Core\Model;
use Exception;

class Post extends Model
{
    public function getAllPosts($limit = null, $offset = null, $order = 'DESC')
    {
        $sql = "SELECT p.*, pt.title as postType, pt.slug, pt.icon, pt.color
                FROM post p
                LEFT JOIN post_type pt ON p.post_type = pt.id
                WHERE p.is_active = 1 
                ORDER BY p.created_at $order 
                LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('ii', $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }



    public function getPostCount()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM post WHERE is_active = 1");
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getPostById($id)
    {
        $sql = "SELECT p.*, pt.title as postType, pt.slug, pt.icon, pt.color
        FROM post p
        LEFT JOIN post_type pt ON p.post_type = pt.id
        WHERE p.id = ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {throw new Exception($this->db->error);}
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getPostsByType($typeId, $limit = null, $offset = null, $order = 'DESC')
    {
        $sql = "SELECT p.*, pt.title as postType, pt.slug, pt.icon, pt.color
        FROM post p
        LEFT JOIN post_type pt ON p.post_type = pt.id
        WHERE p.post_type = ? AND p.is_active = 1 
        ORDER BY p.created_at $order 
        LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('iii', $typeId, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPostsByPostType($postType, $page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post_type = ? ORDER BY id DESC LIMIT ? OFFSET ?");
        $stmt->bind_param('iii', $postType, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPostCountByType($type)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM post WHERE post_type = ? AND is_active = 1");
        $stmt->bind_param('i', $type);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function createPost($data)
    {
        $stmt = $this->db->prepare("INSERT INTO post (post_type, title, caption, full_body, image, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('sssssi', $data['post_type'], $data['title'], $data['caption'], $data['full_body'], $data['image'], $data['is_active']);
        $stmt->execute();
        $stmt->close();
    }

    public function updatePost($id, $data)
    {
        $sql = "UPDATE post SET post_type = ?, title = ?, caption = ?, full_body = ?, image = ?, is_active = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('issssii', $data['post_type'], $data['title'], $data['caption'], $data['full_body'], $data['image'], $data['is_active'], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deletePost($id)
    {
        $stmt = $this->db->prepare("DELETE FROM post WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    private function fetchAssoc($stmt)
    {
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
