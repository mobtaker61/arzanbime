<?php

namespace App\Models;

use Core\Model;

class BrokerPackageCommission extends Model {
    public function getAllCommissions($limit, $offset, $search = '') {
        $sql = "SELECT bpc.*, b.title as broker_title, p.tip as package_tip FROM broker_package_commissions bpc
                JOIN brokers b ON bpc.broker_id = b.id
                JOIN package p ON bpc.package_id = p.id";
        if (!empty($search)) {
            $sql .= " WHERE b.title LIKE ? OR p.tip LIKE ?";
        }
        $sql .= " LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new \Exception("SQL prepare statement failed: " . $this->db->error);
        }
        if (!empty($search)) {
            $search = "%$search%";
            $stmt->bind_param('ssii', $search, $search, $limit, $offset);
        } else {
            $stmt->bind_param('ii', $limit, $offset);
        }
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getCommissionCount($search = '') {
        $sql = "SELECT COUNT(*) as count FROM broker_package_commissions bpc
                JOIN brokers b ON bpc.broker_id = b.id
                JOIN package p ON bpc.package_id = p.id";
        if (!empty($search)) {
            $sql .= " WHERE b.title LIKE ? OR p.tip LIKE ?";
        }
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new \Exception("SQL prepare statement failed: " . $this->db->error);
        }
        if (!empty($search)) {
            $search = "%$search%";
            $stmt->bind_param('ss', $search, $search);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getCommissionById($id) {
        $stmt = $this->db->prepare("SELECT * FROM broker_package_commissions WHERE id = ?");
        if (!$stmt) {
            throw new \Exception("SQL prepare statement failed: " . $this->db->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function createCommission($data) {
        $stmt = $this->db->prepare("INSERT INTO broker_package_commissions (broker_id, package_id, commission_rate) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new \Exception("SQL prepare statement failed: " . $this->db->error);
        }
        $stmt->bind_param('iid', $data['broker_id'], $data['package_id'], $data['commission_rate']);
        $stmt->execute();
        $stmt->close();
    }

    public function updateCommission($id, $data) {
        $stmt = $this->db->prepare("UPDATE broker_package_commissions SET broker_id = ?, package_id = ?, commission_rate = ? WHERE id = ?");
        if (!$stmt) {
            throw new \Exception("SQL prepare statement failed: " . $this->db->error);
        }
        $stmt->bind_param('iidi', $data['broker_id'], $data['package_id'], $data['commission_rate'], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteCommission($id) {
        $stmt = $this->db->prepare("DELETE FROM broker_package_commissions WHERE id = ?");
        if (!$stmt) {
            throw new \Exception("SQL prepare statement failed: " . $this->db->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
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
