<?php
class Office extends Model {
    public function getAllOffices() {
        $stmt = $this->db->prepare("SELECT * FROM office");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getOfficesByProvince($provinceId) {
        $stmt = $this->db->prepare("SELECT * FROM office WHERE province_id = ?");
        $stmt->bind_param('i', $provinceId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
