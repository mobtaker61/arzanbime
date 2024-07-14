<?php

namespace App\Models;

use Core\Model;
use Exception;

class Order extends Model
{
    public function getAllOrders($limit = 100, $offset = 0, $sortField = 'id', $sortOrder = 'DESC', $filterDateStart = null, $filterDateEnd = null, $filterOperator = null, $filterBroker = null){
        $sql = "SELECT o.*, 
                       op.username AS operator_username, op_profile.name AS operator_name, op_profile.surname AS operator_surname,
                       u.username AS user_username, user_profile.name AS user_name, user_profile.surname AS user_surname,
                       p.tip AS package_name, b.title AS broker_name, c.name AS company_name
                FROM orders o
                LEFT JOIN users op ON o.operator_user_id = op.id
                LEFT JOIN profiles op_profile ON op.id = op_profile.user_id
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN profiles user_profile ON u.id = user_profile.user_id
                LEFT JOIN package p ON o.package_id = p.id
                LEFT JOIN brokers b ON o.broker_id = b.id
                LEFT JOIN company c ON p.company_id = c.id
                WHERE 1=1";

        $bindParams = [];
        $types = '';

        if ($filterDateStart && $filterDateEnd) {
            $sql .= " AND o.order_date BETWEEN ? AND ?";
            $bindParams[] = $filterDateStart;
            $bindParams[] = $filterDateEnd;
            $types .= 'ss';
        }

        if ($filterOperator) {
            $sql .= " AND o.operator_user_id = ?";
            $bindParams[] = $filterOperator;
            $types .= 'i';
        }

        if ($filterBroker) {
            $sql .= " AND o.broker_id = ?";
            $bindParams[] = $filterBroker;
            $types .= 'i';
        }

        $sql .= " ORDER BY $sortField $sortOrder LIMIT ? OFFSET ?";
        $bindParams[] = $limit;
        $bindParams[] = $offset;
        $types .= 'ii';

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL prepare failed: " . $this->db->error);
        }

        $stmt->bind_param($types, ...$bindParams);

        if (!$stmt->execute()) {
            throw new Exception("SQL execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function createOrder($data)
    {
        $stmt = $this->db->prepare("INSERT INTO orders (order_date, operator_user_id, user_id, package_id, broker_id, tariff, payment, duration, end_date, auxiliary_info, status) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $stmt->bind_param(
            'iiiiisssss',
            $data['operator_user_id'],
            $data['user_id'],
            $data['package_id'],
            $data['broker_id'],
            $data['tariff'],
            $data['payment'],
            $data['duration'],
            $data['end_date'],
            $data['auxiliary_info'],
            $data['status']
        );

        $stmt->execute();
        $orderId = $stmt->insert_id;
        $stmt->close();
        return $orderId;
    }

    public function getOrderCount($filterDateStart = null, $filterDateEnd = null, $filterOperator = null, $filterBroker = null)
    {
        $sql = "SELECT COUNT(*) AS total 
                FROM orders o
                LEFT JOIN users op ON o.operator_user_id = op.id
                LEFT JOIN profiles op_profile ON op.id = op_profile.user_id
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN profiles user_profile ON u.id = user_profile.user_id
                LEFT JOIN package p ON o.package_id = p.id
                LEFT JOIN brokers b ON o.broker_id = b.id
                WHERE 1=1";
    
        $params = [];
        $types = '';
    
        if ($filterDateStart) {
            $sql .= " AND o.created_at >= ?";
            $types .= 's';
            $params[] = $filterDateStart;
        }
        if ($filterDateEnd) {
            $sql .= " AND o.created_at <= ?";
            $types .= 's';
            $params[] = $filterDateEnd;
        }
        if ($filterOperator) {
            $sql .= " AND o.operator_user_id = ?";
            $types .= 'i';
            $params[] = $filterOperator;
        }
        if ($filterBroker) {
            $sql .= " AND o.broker_id = ?";
            $types .= 'i';
            $params[] = $filterBroker;
        }
    
        $stmt = $this->db->prepare($sql);
    
        if (!$stmt) {
            throw new \Exception("SQL prepare failed: " . $this->db->error);
        }
    
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data['total'];
    }
    
}
