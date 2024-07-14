<?php

namespace App\Models;

use Core\Model;
use Exception;

class BrokerTransaction extends Model
{
    public function getAllBrokerTransactions($limit = 10, $offset = 0, $sortField = 'id', $sortOrder = 'DESC', $filterDateStart = null, $filterDateEnd = null, $filterBrokerId = null)
    {
        $sql = "SELECT bt.*, tt.name as type_name, b.title as broker_name, o.id as order_id
                FROM broker_transactions bt
                LEFT JOIN transaction_types tt ON bt.transaction_type_id = tt.id
                LEFT JOIN brokers b ON bt.broker_id = b.id
                LEFT JOIN orders o ON bt.order_id = o.id
                WHERE 1=1";

        $params = [];
        $types = '';

        if ($filterDateStart) {
            $sql .= " AND bt.transaction_date >= ?";
            $types .= 's';
            $params[] = $filterDateStart;
        }
        if ($filterDateEnd) {
            $sql .= " AND bt.transaction_date <= ?";
            $types .= 's';
            $params[] = $filterDateEnd;
        }
        if ($filterBrokerId) {
            $sql .= " AND bt.broker_id = ?";
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

    public function getBrokerTransactionCount($filterDateStart = null, $filterDateEnd = null, $filterBrokerId = null)
    {
        $sql = "SELECT COUNT(*) as count FROM broker_transactions bt
                LEFT JOIN transaction_types tt ON bt.transaction_type_id = tt.id
                LEFT JOIN brokers b ON bt.broker_id = b.id
                LEFT JOIN orders o ON bt.order_id = o.id
                WHERE 1=1";

        $params = [];
        $types = '';

        if ($filterDateStart) {
            $sql .= " AND bt.transaction_date >= ?";
            $types .= 's';
            $params[] = $filterDateStart;
        }
        if ($filterDateEnd) {
            $sql .= " AND bt.transaction_date <= ?";
            $types .= 's';
            $params[] = $filterDateEnd;
        }
        if ($filterBrokerId) {
            $sql .= " AND bt.broker_id = ?";
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

    public function createBrokerTransaction($data)
    {
        $stmt = $this->db->prepare("INSERT INTO broker_transactions (transaction_date, transaction_type_id, broker_id, order_id, description, debit, credit) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $orderId = !empty($data['order_id']) ? $data['order_id'] : null;
        $stmt->bind_param('siiisdd', $data['transaction_date'], $data['transaction_type_id'], $data['broker_id'], $orderId, $data['description'], $data['debit'], $data['credit']);

        $stmt->execute();
        $stmt->close();
    }

    public function updateBrokerTransaction($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE broker_transactions SET transaction_date = ?, transaction_type_id = ?, broker_id = ?, order_id = ?, description = ?, debit = ?, credit = ? WHERE id = ?");

        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $orderId = !empty($data['order_id']) ? $data['order_id'] : null;
        $stmt->bind_param('siiisddi', $data['transaction_date'], $data['transaction_type_id'], $data['broker_id'], $orderId, $data['description'], $data['debit'], $data['credit'], $id);

        $stmt->execute();
        $stmt->close();
    }

    public function getBrokerTransactionById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM broker_transactions WHERE id = ?");
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