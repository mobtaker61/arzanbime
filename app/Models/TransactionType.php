<?php

namespace App\Models;

use Core\Model;
use Exception;

class TransactionType extends Model
{
    public function getAllTransactionTypes()
    {
        $stmt = $this->db->prepare("SELECT * FROM transaction_types");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function createTransactionType($data)
    {
        $stmt = $this->db->prepare("INSERT INTO transaction_types (name, description) VALUES (?, ?)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('ss', $data['name'], $data['description']);
        $stmt->execute();
        $stmt->close();
    }

    public function updateTransactionType($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE transaction_types SET name = ?, description = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('ssi', $data['name'], $data['description'], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteTransactionType($id)
    {
        $stmt = $this->db->prepare("DELETE FROM transaction_types WHERE id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
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
