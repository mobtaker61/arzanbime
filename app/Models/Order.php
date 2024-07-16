<?php

namespace App\Models;

use Core\Model;
use Exception;

class Order extends Model
{
    public function getAllOrders($limit = 100, $offset = 0, $sortField = 'id', $sortOrder = 'DESC', $filterDateStart = null, $filterDateEnd = null, $filterOperator = null, $filterBroker = null)
    {
        $sql = "SELECT o.*, 
                       op.username AS operator_username, op_profile.name AS operator_name, op_profile.surname AS operator_surname,
                       u.username AS user_username, user_profile.name AS user_name, user_profile.surname AS user_surname, user_profile.phone, user_profile.birth_date,
                       p.tip AS package_name, b.title AS broker_name, 
                       c.name AS company_name, c.icon AS company_icon
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

        if ($filterDateStart) {
            $sql .= " AND o.end_date >= ?";
            $types .= 's';
            $bindParams[] = $filterDateStart;
        }
        if ($filterDateEnd) {
            $sql .= " AND o.end_date <= ?";
            $types .= 's';
            $bindParams[] = $filterDateEnd;
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

        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getOrderById($id)
    {
        $stmt = $this->db->prepare("SELECT o.*, u.username as user_username,
                        p.tip as package_name, b.title as broker_name, 
                        c.name as company_name, c.icon as company_icon
                                FROM orders o
                                LEFT JOIN users u ON o.user_id = u.id
                                LEFT JOIN package p ON o.package_id = p.id
                                LEFT JOIN brokers b ON o.broker_id = b.id
                                LEFT JOIN company c ON p.company_id = c.id
                                WHERE o.id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
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

    public function getOrderDates($startDate, $endDate)
    {
        $stmt = $this->db->prepare("SELECT DISTINCT DATE(order_date) as order_date FROM orders WHERE order_date BETWEEN ? AND ? ORDER BY order_date");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();

        $dates = [];
        foreach ($result as $row) {
            $dates[] = $row['order_date'];
        }
        return $dates;
    }

    public function getOrderData($startDate, $endDate)
    {
        $stmt = $this->db->prepare("SELECT c.name as company_name, DATE(o.order_date) as order_date, COUNT(o.id) as order_count
                                    FROM orders o
                                    JOIN package p ON o.package_id = p.id
                                    JOIN company c ON p.company_id = c.id
                                    WHERE o.order_date BETWEEN ? AND ?
                                    GROUP BY c.name, DATE(o.order_date)
                                    ORDER BY DATE(o.order_date)");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();

        $allDates = $this->generateDateRange($startDate, $endDate);
        $companies = [];
        foreach ($result as $row) {
            $companies[$row['company_name']][$row['order_date']] = $row['order_count'];
        }

        foreach ($companies as $company => $data) {
            foreach ($allDates as $date) {
                if (!isset($companies[$company][$date])) {
                    $companies[$company][$date] = 0;
                }
            }
        }

        return $companies;
    }

    public function generateDateRange($startDate, $endDate)
    {
        $dates = [];
        $current = strtotime($startDate);
        $end = strtotime($endDate);

        while ($current <= $end) {
            $dates[] = date('Y-m-d', $current);
            $current = strtotime('+1 day', $current);
        }

        return $dates;
    }

    public function getTotalFinishedOrders($startDate, $endDate)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total_orders FROM orders WHERE status = 'Finished' AND order_date BETWEEN ? AND ?");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['total_orders'] ?? 0;
    }

    public function getNewOrdersCount()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM orders WHERE status = 'new'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['count'];
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
