<?php

namespace App\Models;

use Core\Model;
use Exception;

class Quotation extends Model
{
    public function getAllQuotations($limit = 10, $offset = 1, $sortField = 'id', $sortOrder = 'DESC', $filterTel = null, $filterStatus = null)
    {
        $sql = "SELECT q.*, u.user_level_id, p.name, p.surname, p.profile_image 
            FROM quotation q
            LEFT JOIN users u ON q.user_id = u.id
            LEFT JOIN profiles p ON q.user_id = p.user_id
            WHERE 1=1";

        if ($filterTel) {
            $sql .= " AND q.tel LIKE ?";
        }

        if ($filterStatus) {
            $sql .= " AND q.status = ?";
        }

        $sql .= " ORDER BY $sortField $sortOrder LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);
        if ($filterTel && $filterStatus) {
            $filterTel = "%$filterTel%";
            $stmt->bind_param('ssii', $filterTel, $filterStatus, $limit, $offset);
        } elseif ($filterTel) {
            $filterTel = "%$filterTel%";
            $stmt->bind_param('sii', $filterTel, $limit, $offset);
        } elseif ($filterStatus) {
            $stmt->bind_param('sii', $filterStatus, $limit, $offset);
        } else {
            $stmt->bind_param('ii', $limit, $offset);
        }

        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getQuotation($identifier)
    {
        // Determine if the identifier is numeric (ID) or not (UID)
        if (is_numeric($identifier)) {
            $stmt = $this->db->prepare("SELECT q.*, u.user_level_id, p.name, p.surname, p.profile_image 
                                        FROM quotation q 
                                        LEFT JOIN users u ON q.user_id = u.id 
                                        LEFT JOIN profiles p ON q.user_id = p.user_id 
                                        WHERE q.id = ?");
            $stmt->bind_param("i", $identifier);
        } else {
            $stmt = $this->db->prepare("SELECT q.*, u.user_level_id, p.name, p.surname, p.profile_image 
                                        FROM quotation q 
                                        LEFT JOIN users u ON q.user_id = u.id 
                                        LEFT JOIN profiles p ON q.user_id = p.user_id 
                                        WHERE q.uid = ?");
            $stmt->bind_param("s", $identifier);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
        $quotation = $result->fetch_assoc();
        $stmt->close();
        return $quotation;
    }

    public function getQuotationCount($filterTel, $filterStatus)
    {
        $sql = "SELECT COUNT(*) as count FROM quotation WHERE 1=1";

        if ($filterTel) {
            $sql .= " AND tel LIKE ?";
        }

        if ($filterStatus) {
            $sql .= " AND status = ?";
        }

        $stmt = $this->db->prepare($sql);
        if ($filterTel && $filterStatus) {
            $filterTel = "%$filterTel%";
            $stmt->bind_param('ss', $filterTel, $filterStatus);
        } elseif ($filterTel) {
            $filterTel = "%$filterTel%";
            $stmt->bind_param('s', $filterTel);
        } elseif ($filterStatus) {
            $stmt->bind_param('s', $filterStatus);
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function createQuotation($data)
    {
        $uid = $this->generateUid();
        $stmt = $this->db->prepare("INSERT INTO quotation (user_id, birth_date, age, duration, tel, status, uid) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('issiiss', $data['user_id'], $data['birth_date'], $data['age'], $data['duration'], $data['tel'],$data['status'], $uid);
        $stmt->execute();
        $stmt->close();
        return $uid;
    }

    public function getTotalQuotations($startDate, $endDate) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total_quotations FROM quotation WHERE created_at BETWEEN ? AND ?");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['total_quotations'] ?? 0;
    }
    
    public function getNewQuotationsCount() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM quotation WHERE status = 'new'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['count'];
    }
    
    private function generateUid()
    {
        return bin2hex(random_bytes(16));
    }

    public function updateQuotation($id, $tel, $birth_date, $age, $duration, $status)
    {
        $stmt = $this->db->prepare("UPDATE quotation SET tel = ?, birth_date = ?, age = ?, duration = ?, status = ? WHERE id = ?");
        $stmt->bind_param('ssissi', $tel, $birth_date, $age, $duration, $status, $id);
        return $stmt->execute();
    }

    public function deleteQuotation($id)
    {
        $stmt = $this->db->prepare("DELETE FROM quotation WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
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
