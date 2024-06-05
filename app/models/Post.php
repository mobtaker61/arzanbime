<?php
class Post extends Model {
    public function getAllPosts() {
        $result = $this->db->query("SELECT * FROM posts");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
