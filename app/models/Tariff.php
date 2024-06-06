<?php
class Tariff extends Model {
    public function getTariffsByPackage($packageId) {
        $stmt = $this->db->prepare("SELECT * FROM tariff WHERE package_id = ?");
        $stmt->bind_param('i', $packageId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
