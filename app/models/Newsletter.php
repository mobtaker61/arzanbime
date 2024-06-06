<?php
class Newsletter extends Model {
    public function getAllNewsletters() {
        $stmt = $this->db->prepare("SELECT * FROM newsletter");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function createNewsletter($data) {
        $stmt = $this->db->prepare("INSERT INTO newsletter (uid, tel, ip, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sssi', $data['uid'], $data['tel'], $data['ip'], $data['user_id']);
        return $stmt->execute();
    }
}
