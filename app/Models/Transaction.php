<?php

namespace App\Models;

use Core\Model;
use Exception;

class Transaction extends Model
{
    public function getAllTransactions($limit = 10, $offset = 0, $sortField = 'id', $sortOrder = 'DESC', $filterDateStart = null, $filterDateEnd = null, $filterUserId = null, $filterBrokerId = null)
    {
        $sql = "SELECT t.*, tt.name as type_name, u.username as user_username, b.title as broker_name, o.id as order_id
                FROM transactions t
                LEFT JOIN transaction_types tt ON t.transaction_type_id = tt.id
                LEFT JOIN users u ON t.user_id = u.id
                LEFT JOIN orders o ON t.order_id = o.id
                LEFT JOIN brokers b ON o.broker_id = b.id
                WHERE 1=1";

        $params = [];
        $types = '';

        if ($filterDateStart) {
            $sql .= " AND t.transaction_date >= ?";
            $types .= 's';
            $params[] = $filterDateStart;
        }
        if ($filterDateEnd) {
            $sql .= " AND t.transaction_date <= ?";
            $types .= 's';
            $params[] = $filterDateEnd;
        }
        if ($filterUserId) {
            $sql .= " AND t.user_id = ?";
            $types .= 'i';
            $params[] = $filterUserId;
        }
        if ($filterBrokerId) {
            $sql .= " AND o.broker_id = ?";
            $types .= 'i';
            $params[] = $filterBrokerId;
        }

        $sql .= " ORDER BY $sortField $sortOrder LIMIT ? OFFSET ?";
        $types .= 'ii';
        $params[] = $limit;
        $params[] = $offset;

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $stmt->bind_param($types, ...$params);

        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getTransactionCount($filterDateStart = null, $filterDateEnd = null, $filterUserId = null, $filterBrokerId = null)
    {
        $sql = "SELECT COUNT(*) as count
                FROM transactions t
                LEFT JOIN transaction_types tt ON t.transaction_type_id = tt.id
                LEFT JOIN users u ON t.user_id = u.id
                LEFT JOIN orders o ON t.order_id = o.id
                LEFT JOIN brokers b ON o.broker_id = b.id
                WHERE 1=1";

        $params = [];
        $types = '';

        if ($filterDateStart) {
            $sql .= " AND t.transaction_date >= ?";
            $types .= 's';
            $params[] = $filterDateStart;
        }
        if ($filterDateEnd) {
            $sql .= " AND t.transaction_date <= ?";
            $types .= 's';
            $params[] = $filterDateEnd;
        }
        if ($filterUserId) {
            $sql .= " AND t.user_id = ?";
            $types .= 'i';
            $params[] = $filterUserId;
        }
        if ($filterBrokerId) {
            $sql .= " AND o.broker_id = ?";
            $types .= 'i';
            $params[] = $filterBrokerId;
        }

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        if ($types) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['count'];
    }

    public function createTransaction($data)
    {
        $stmt = $this->db->prepare("INSERT INTO transactions (transaction_date, transaction_type_id, order_id, user_id, description, debit, credit) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $orderId = !empty($data['order_id']) ? $data['order_id'] : null;
        $stmt->bind_param('siiisdd', $data['transaction_date'], $data['transaction_type_id'], $orderId, $data['user_id'], $data['description'], $data['debit'], $data['credit']);

        $stmt->execute();
        $stmt->close();
    }

    public function updateTransaction($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE transactions SET transaction_date = ?, transaction_type_id = ?, order_id = ?, user_id = ?, description = ?, debit = ?, credit = ? WHERE id = ?");

        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $orderId = !empty($data['order_id']) ? $data['order_id'] : null;
        $stmt->bind_param('siiisddi', $data['transaction_date'], $data['transaction_type_id'], $orderId, $data['user_id'], $data['description'], $data['debit'], $data['credit'], $id);

        $stmt->execute();
        $stmt->close();
    }

    public function deleteTransaction($id)
    {
        $stmt = $this->db->prepare("DELETE FROM transactions WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getTransactionById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
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
