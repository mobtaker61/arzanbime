<?php

namespace App\Models;

use Core\Model;

class PackageDiscount extends Model
{
    public function getAllPackageDiscounts()
    {
        $stmt = $this->db->prepare("SELECT pd.*, p.tip, ul.name as user_level_name, c.name as company_name
            FROM package_discounts pd 
            JOIN package p ON pd.package_id = p.id 
            JOIN company c ON p.company_id = c.id 
            JOIN user_levels ul ON pd.user_level_id = ul.id");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPackageDiscountById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM package_discounts WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function createPackageDiscount($data)
    {
        $stmt = $this->db->prepare("INSERT INTO package_discounts (package_id, user_level_id, discount_rate) VALUES (?, ?, ?)");
        $stmt->bind_param('iid', $data['package_id'], $data['user_level_id'], $data['discount_rate']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updatePackageDiscount($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE package_discounts SET package_id = ?, user_level_id = ?, discount_rate = ? WHERE id = ?");
        $stmt->bind_param('iidi', $data['package_id'], $data['user_level_id'], $data['discount_rate'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deletePackageDiscount($id)
    {
        $stmt = $this->db->prepare("DELETE FROM package_discounts WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    private function fetchAssoc($stmt)
    {
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
