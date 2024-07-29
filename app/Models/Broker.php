<?php

namespace App\Models;

use Core\Model;
use Exception;

class Broker extends Model
{
    public function getAllBrokers($limit = 10, $offset = 0, $search = '')
    {
        $search = '%' . $search . '%';
        $stmt = $this->db->prepare("SELECT * FROM brokers WHERE title LIKE ? OR manager LIKE ? OR address LIKE ? OR phone LIKE ? OR website LIKE ? OR email LIKE ? LIMIT ? OFFSET ?");
        $stmt->bind_param('ssssssii', $search, $search, $search, $search, $search, $search, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getBrokerCount($search = '')
    {
        $search = '%' . $search . '%';
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM brokers WHERE title LIKE ? OR manager LIKE ? OR address LIKE ? OR phone LIKE ? OR website LIKE ? OR email LIKE ?");
        $stmt->bind_param('ssssss', $search, $search, $search, $search, $search, $search);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getBrokerById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM brokers WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getBrokerBalance($broker_id)
    {
        $stmt = $this->db->prepare("SELECT SUM(credit - debit) as balance FROM broker_transactions WHERE broker_id = ?");
        $stmt->bind_param('i', $broker_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['balance'];
    }

    public function createBroker($data)
    {
        $stmt = $this->db->prepare("INSERT INTO brokers (logo, title, manager, address, phone, website, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('sssssss', $data['logo'], $data['title'], $data['manager'], $data['address'], $data['phone'], $data['website'], $data['email']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateBroker($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE brokers SET logo = ?, title = ?, manager = ?, address = ?, phone = ?, website = ?, email = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('sssssssi', $data['logo'], $data['title'], $data['manager'], $data['address'], $data['phone'], $data['website'], $data['email'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteBroker($id)
    {
        $stmt = $this->db->prepare("DELETE FROM brokers WHERE id = ?");
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
