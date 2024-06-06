<?php
class Configuration extends Model {
    public function getAllConfigurations() {
        $stmt = $this->db->prepare("SELECT * FROM configuration");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
