<?php

namespace App\Models;

use Core\Model;
use Exception;

class Tariff extends Model
{
    public function gettariffs($companyId, $packageId, $limit, $offset, $sortField = 'age', $sortOrder = 'ASC')
    {
        $sql = "SELECT t.*, p.tip as package_tip, c.name as company_name 
                FROM tariff t
                LEFT JOIN package p ON t.package_id = p.id
                LEFT JOIN company c ON p.company_id = c.id 
                WHERE 1=1";

        if ($companyId) {
            $sql .= " AND c.id = ?";
        }

        if ($packageId) {
            $sql .= " AND p.id = ?";
        }

        $sql .= " ORDER BY $sortField $sortOrder LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);

        if ($companyId && $packageId) {
            $stmt->bind_param('iiii', $companyId, $packageId, $limit, $offset);
        } elseif ($companyId) {
            $stmt->bind_param('iii', $companyId, $limit, $offset);
        } elseif ($packageId) {
            $stmt->bind_param('iii', $packageId, $limit, $offset);
        } else {
            $stmt->bind_param('ii', $limit, $offset);
        }

        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getTariffCount($companyId, $packageId)
    {
        $sql = "SELECT COUNT(*) as count 
                FROM tariff t
                LEFT JOIN package p ON t.package_id = p.id
                LEFT JOIN company c ON p.company_id = c.id 
                WHERE 1=1";

        if ($companyId) {
            $sql .= " AND c.id = ?";
        }

        if ($packageId) {
            $sql .= " AND p.id = ?";
        }

        $stmt = $this->db->prepare($sql);

        if ($companyId && $packageId) {
            $stmt->bind_param('ii', $companyId, $packageId);
        } elseif ($companyId) {
            $stmt->bind_param('i', $companyId);
        } elseif ($packageId) {
            $stmt->bind_param('i', $packageId);
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function createTariff($packageId, $age, $firstYear, $secondYear, $twoYear)
    {
        $stmt = $this->db->prepare("INSERT INTO tariff (package_id, age, first_year, second_year, two_year) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiii', $packageId, $age, $firstYear, $secondYear, $twoYear);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getTariffById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tariff WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getTariffsByAge($age)
    {
        $sql = "SELECT t.*, 
                       p.tip as package_tip, 
                       p.discount_rate as commission,
                       c.name as company_name, 
                       c.icon as company_icon, 
                       c.color as company_color 
                FROM tariff t
                LEFT JOIN package p ON t.package_id = p.id
                LEFT JOIN company c ON p.company_id = c.id 
                WHERE age = ? AND p.is_active = 1";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('i', $age);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getTariff($packageId, $age, $duration)
    {
        $column = $duration == 1 ? 'first_year' : 'second_year';
        $stmt = $this->db->prepare("SELECT $column AS tariff FROM tariff WHERE package_id = ? AND age = ?");
        $stmt->bind_param('ii', $packageId, $age);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ? $result['tariff'] : null;
    }    

    public function getTariffsByPackage($packageId)
    {
        $stmt = $this->db->prepare("SELECT * FROM tariff WHERE package_id = ? ORDER BY age ASC");
        $stmt->bind_param('i', $packageId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTariffsByPackageId($packageId, $limit, $offset, $sortField, $sortOrder)
    {
        $sql = "SELECT t.*, 
                       p.tip as package_tip, 
                       p.discount_rate as commission,
                       c.name as company_name, 
                       c.icon as company_icon, 
                       c.color as company_color 
                FROM tariff t
                LEFT JOIN package p ON t.package_id = p.id
                LEFT JOIN company c ON p.company_id = c.id 
                WHERE t.package_id = ?
                ORDER BY $sortField $sortOrder
                LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('iii', $packageId, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getHighestCommission($packageId)
    {
        $stmt = $this->db->prepare("SELECT brokers.title, broker_package_commissions.commission_rate, brokers.id AS broker_id 
                                    FROM broker_package_commissions
                                    JOIN brokers ON broker_package_commissions.broker_id = brokers.id
                                    WHERE broker_package_commissions.package_id = ?
                                    ORDER BY broker_package_commissions.commission_rate DESC
                                    LIMIT 1");
        $stmt->bind_param('i', $packageId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function getTariffCountByPackageId($packageId)
    {
        $sql = "SELECT COUNT(*) as count 
                FROM tariff t
                LEFT JOIN package p ON t.package_id = p.id
                LEFT JOIN company c ON p.company_id = c.id 
                WHERE t.package_id = ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('i', $packageId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getTariffsByCompanyId($companyId)
    {
        $stmt = $this->db->prepare("SELECT t.*, p.tip as package_tip, p.color as package_color, c.name as company_name, c.icon as company_icon, c.color as company_color 
            FROM tariff t
            LEFT JOIN package p ON t.package_id = p.id
            LEFT JOIN company c ON p.company_id = c.id 
            WHERE c.id = ?
            ORDER BY package_id ASC, age ASC");
        $stmt->bind_param('i', $companyId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function getPackageDiscount($packageId, $userLevelId)
    {
        $stmt = $this->db->prepare("SELECT discount_rate FROM package_discounts WHERE package_id = ? AND user_level_id = ?");
        $stmt->bind_param('ii', $packageId, $userLevelId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ? $result['discount_rate'] : null;
    }

    public function updateTariff($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE tariff SET package_id = ?, age = ?, first_year = ?, second_year = ?, two_year = ? WHERE id = ?");
        $stmt->bind_param('iiiiii', $data['package_id'], $data['age'], $data['first_year'], $data['second_year'], $data['two_year'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateField($id, $first_year, $second_year, $two_year)
    {
        $stmt = $this->db->prepare("UPDATE tariff SET first_year = ?, second_year = ?, two_year = ? WHERE id = ?");
        $stmt->bind_param('iiii', $first_year, $second_year, $two_year, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function setTariffForAgeRange($packageId, $startAge, $endAge, $firstYear, $secondYear, $twoYear)
    {
        $stmt = $this->db->prepare("UPDATE tariff SET first_year = ?, second_year = ?, two_year = ? WHERE package_id = ? AND age BETWEEN ? AND ?");
        $stmt->bind_param('iiiiii', $firstYear, $secondYear, $twoYear, $packageId, $startAge, $endAge);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteTariff($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tariff WHERE id = ?");
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
