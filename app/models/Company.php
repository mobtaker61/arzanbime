<?php
class Company extends Model {
    public function getAllCompanies() {
        $stmt = $this->db->prepare("SELECT * FROM company WHERE is_active = 1");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getCompanyById($id) {
        $stmt = $this->db->prepare("SELECT * FROM company WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
