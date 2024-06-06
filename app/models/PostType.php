<?php
class PostType extends Model {
    public function getAllPostTypes() {
        $stmt = $this->db->prepare("SELECT * FROM post_type");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
