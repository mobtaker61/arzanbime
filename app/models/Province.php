<?php
class Province extends Model {
    public function getAllProvinces() {
        $stmt = $this->db->prepare("SELECT * FROM province");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
