<?php

namespace App\Models;

use Core\Model;
use Core\Database;
use Exception;

class Order extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
    }

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
            throw new Exception("SQL prepare failed: " . $this->db->error());
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
            throw new Exception($this->db->error());
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
            throw new \Exception("SQL prepare failed: " . $this->db->error());
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

    /**
     * Get the count of orders for a specific agent
     *
     * @param int $agentId The agent's user ID
     * @return int The count of orders
     */
    public function getOrdersCountByAgent(int $agentId): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM orders WHERE operator_user_id = ?");
        $stmt->bind_param('i', $agentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return (int) $row['count'];
    }

    /**
     * Get recent orders for a specific agent
     *
     * @param int $agentId The agent's user ID
     * @param int $limit Number of orders to return
     * @return array Array of recent orders
     */
    public function getRecentOrdersByAgent(int $agentId, int $limit = 5): array
    {
        $sql = "SELECT o.*, 
                       u.username AS user_username, 
                       user_profile.name AS user_name, 
                       user_profile.surname AS user_surname,
                       p.tip AS package_name, 
                       c.name AS company_name, 
                       c.icon AS company_icon
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN profiles user_profile ON u.id = user_profile.user_id
                LEFT JOIN package p ON o.package_id = p.id
                LEFT JOIN company c ON p.company_id = c.id
                WHERE o.operator_user_id = ?
                ORDER BY o.order_date DESC
                LIMIT ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $agentId, $limit);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        
        return $result;
    }

    public function getOrdersByAgentAndDateRange(int $agentId, string $startDate, string $endDate): array
    {
        $sql = "SELECT o.*, 
                       u.username AS user_username, 
                       user_profile.name AS user_name, 
                       user_profile.surname AS user_surname,
                       p.tip AS package_name, 
                       b.title AS broker_name,
                       c.name AS company_name, 
                       c.icon AS company_icon
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN profiles user_profile ON u.id = user_profile.user_id
                LEFT JOIN package p ON o.package_id = p.id
                LEFT JOIN brokers b ON o.broker_id = b.id
                LEFT JOIN company c ON p.company_id = c.id
                WHERE o.operator_user_id = ?
                AND o.end_date BETWEEN ? AND ?
                ORDER BY o.end_date ASC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL prepare failed: " . $this->db->error());
        }

        $stmt->bind_param('iss', $agentId, $startDate, $endDate);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getAgentOrders($agent_id, $limit, $offset, $dateStart = '', $dateEnd = '', $brokerId = '')
    {
        $sql = "SELECT o.*, 
                       p.name as client_name, 
                       p.surname as client_surname,
                       pkg.tip as package_name, 
                       comp.name as company_name, 
                       comp.icon as company_icon,
                       b.title as broker_name
                FROM orders o
                LEFT JOIN clients c ON o.user_id = c.id
                LEFT JOIN profiles p ON c.id = p.user_id
                LEFT JOIN package pkg ON o.package_id = pkg.id
                LEFT JOIN company comp ON pkg.company_id = comp.id
                LEFT JOIN brokers b ON o.broker_id = b.id
                WHERE o.operator_user_id = ?";
        
        $params = [$agent_id];
        $types = "i";

        if ($dateStart && $dateEnd) {
            $sql .= " AND o.order_date BETWEEN ? AND ?";
            $params[] = $dateStart;
            $params[] = $dateEnd;
            $types .= "ss";
        }

        if ($brokerId) {
            $sql .= " AND o.broker_id = ?";
            $params[] = $brokerId;
            $types .= "i";
        }

        $sql .= " ORDER BY o.order_date DESC, o.id DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->db->error());
        }

        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        
        $stmt->close();
        return $orders;
    }

    public function getAgentOrdersCount($agent_id, $dateStart = '', $dateEnd = '', $brokerId = '')
    {
        $sql = "SELECT COUNT(*) as total FROM orders WHERE operator_user_id = ?";
        $params = [$agent_id];
        $types = "i";

        if ($dateStart && $dateEnd) {
            $sql .= " AND order_date BETWEEN ? AND ?";
            $params[] = $dateStart;
            $params[] = $dateEnd;
            $types .= "ss";
        }

        if ($brokerId) {
            $sql .= " AND broker_id = ?";
            $params[] = $brokerId;
            $types .= "i";
        }

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->db->error());
        }

        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $stmt->close();
        return $row['total'];
    }

    public function getAgentOrderById($agent_id, $id)
    {
        $sql = "SELECT o.*, 
                       c.national_code as client_code,
                       p.name as client_name, 
                       p.surname as client_surname,
                       pkg.tip as package_name, 
                       comp.name as company_name,
                       b.title as broker_name
                FROM orders o
                LEFT JOIN clients c ON o.client_id = c.id
                LEFT JOIN profiles p ON c.id = p.client_id
                LEFT JOIN package pkg ON o.package_id = pkg.id
                LEFT JOIN company comp ON pkg.company_id = comp.id
                LEFT JOIN brokers b ON o.broker_id = b.id
                WHERE o.operator_user_id = ? AND o.id = ?";
        
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->db->error());
        }

        $stmt->bind_param("ii", $agent_id, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
        
        $stmt->close();
        return $order;
    }

    public function create($data)
    {
        $sql = "INSERT INTO orders (client_id, package_id, duration, start_date, end_date, 
                                  tariff, payment, auxiliary_info, broker_id, operator_user_id, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->db->error());
        }

        $stmt->bind_param("iiissddssss", 
            $data['client_id'],
            $data['package_id'],
            $data['duration'],
            $data['start_date'],
            $data['end_date'],
            $data['tariff'],
            $data['payment'],
            $data['auxiliary_info'],
            $data['broker_id'],
            $data['operator_user_id'],
            $data['status']
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function update($id, $data)
    {
        $sql = "UPDATE orders SET 
                client_id = ?,
                package_id = ?,
                duration = ?,
                start_date = ?,
                end_date = ?,
                tariff = ?,
                payment = ?,
                auxiliary_info = ?,
                broker_id = ?,
                status = ?
                WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->db->error());
        }

        $stmt->bind_param("iiissddsssi", 
            $data['client_id'],
            $data['package_id'],
            $data['duration'],
            $data['start_date'],
            $data['end_date'],
            $data['tariff'],
            $data['payment'],
            $data['auxiliary_info'],
            $data['broker_id'],
            $data['status'],
            $id
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->db->error());
        }

        $stmt->bind_param("i", $id);
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
