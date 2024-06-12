<?php
namespace App\Models;

use Core\Model;

class Office extends Model {
    public function getAllOffices() {
        $stmt = $this->db->prepare("SELECT * FROM office");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getOfficesByProvinceId($provinceId) {
        $stmt = $this->db->prepare("SELECT * FROM office WHERE province_id = ?");
        $stmt->bind_param('i', $provinceId);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    private function fetchAssoc($stmt) {
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
