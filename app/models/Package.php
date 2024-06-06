<?php
class Package extends Model {
    public function getAllPackages() {
        $stmt = $this->db->prepare("SELECT * FROM package WHERE is_active = 1");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPackagesByCompany($companyId) {
        $stmt = $this->db->prepare("SELECT * FROM package WHERE company_id = ?");
        $stmt->bind_param('i', $companyId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
