<?php

namespace App\Models;

use Core\Model;

class Package extends Model
{
    public function getAllPackages()
    {
        $stmt = $this->db->prepare("SELECT package.*, company.name as company_name FROM package JOIN company ON package.company_id = company.id");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPackages($limit, $offset, $sortField, $sortOrder, $companyId = null)
    {
        $sql = "SELECT p.*, c.name as company_name, 
                (SELECT COUNT(*) FROM tariff t WHERE t.package_id = p.id) as has_tariffs
                FROM package p
                LEFT JOIN company c ON p.company_id = c.id 
                WHERE 1=1";

        if ($companyId) {
            $sql .= " AND c.id = ?";
        }

        $sql .= " ORDER BY $sortField $sortOrder LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);

        if ($companyId) {
            $stmt->bind_param('iii', $companyId, $limit, $offset);
        } else {
            $stmt->bind_param('ii', $limit, $offset);
        }

        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPackageCount($company_id = null)
    {
        $query = "SELECT COUNT(*) as count FROM package";
        if ($company_id) {
            $query .= " WHERE company_id = ?";
        }

        $stmt = $this->db->prepare($query);

        if ($company_id) {
            $stmt->bind_param('i', $company_id);
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count;
    }

    public function getPackageById($id)
    {
        $stmt = $this->db->prepare("SELECT package.*, company.name as company_name FROM package JOIN company ON package.company_id = company.id WHERE package.id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getPackagesByCompany($company_id)
    {
        $stmt = $this->db->prepare("SELECT package.*, company.name as company_name FROM package JOIN company ON package.company_id = company.id WHERE package.company_id = ?");
        $stmt->bind_param('i', $company_id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function createPackage($data)
    {
        $stmt = $this->db->prepare("INSERT INTO package (company_id, tip, discount_rate, sort, is_active, color) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isiiis', $data['company_id'], $data['tip'], $data['discount_rate'], $data['sort'], $data['is_active'], $data['color']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updatePackage($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE package SET company_id = ?, tip = ?, discount_rate = ?, sort = ?, is_active = ?, color = ? WHERE id = ?");
        $stmt->bind_param('isiiisi', $data['company_id'], $data['tip'], $data['discount_rate'], $data['sort'], $data['is_active'], $data['color'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deletePackage($id)
    {
        $stmt = $this->db->prepare("DELETE FROM package WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getDiscountedPackagesByUserLevel($userId) {
        // ابتدا سطح کاربر را دریافت می‌کنیم
        $userModel = new User($this->db);
        $userLevel = $userModel->getUserLevel($userId);

        // سپس بسته‌های تخفیف‌دار براساس سطح کاربر را دریافت می‌کنیم
        $stmt = $this->db->prepare(
            "SELECT p.*, pd.discount_rate 
            FROM package p
            JOIN package_discounts pd ON p.id = pd.package_id
            WHERE pd.user_level_id = ?"
        );
        $stmt->bind_param('i', $userLevel['id']);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
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
