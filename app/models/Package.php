<?php
class Package extends Model {
    public function getAllPackages() {
        $stmt = $this->db->prepare("SELECT package.*, company.name as company_name FROM package JOIN company ON package.company_id = company.id");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPackages($limit, $offset, $sortField, $sortOrder, $company_id = null) {
        $query = "SELECT package.*, company.name as company_name FROM package JOIN company ON package.company_id = company.id";
        if ($company_id) {
            $query .= " WHERE package.company_id = ?";
        }
        $query .= " ORDER BY $sortField $sortOrder LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($query);
        
        if ($company_id) {
            $stmt->bind_param('iii', $company_id, $limit, $offset);
        } else {
            $stmt->bind_param('ii', $limit, $offset);
        }
        
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getPackageCount($company_id = null) {
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

    public function getPackageById($id) {
        $stmt = $this->db->prepare("SELECT package.*, company.name as company_name FROM package JOIN company ON package.company_id = company.id WHERE package.id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getPackagesByCompany($company_id) {
        $stmt = $this->db->prepare("SELECT package.*, company.name as company_name FROM package JOIN company ON package.company_id = company.id WHERE package.company_id = ?");
        $stmt->bind_param('i', $company_id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function createPackage($data) {
        $stmt = $this->db->prepare("INSERT INTO package (company_id, tip, discount_rate, sort, is_active) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('issii', $data['company_id'], $data['tip'], $data['discount_rate'], $data['sort'], $data['is_active']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updatePackage($id, $data) {
        $stmt = $this->db->prepare("UPDATE package SET company_id = ?, tip = ?, discount_rate = ?, sort = ?, is_active = ? WHERE id = ?");
        $stmt->bind_param('issiii', $data['company_id'], $data['tip'], $data['discount_rate'], $data['sort'], $data['is_active'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deletePackage($id) {
        $stmt = $this->db->prepare("DELETE FROM package WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
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
