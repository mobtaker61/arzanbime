<?php
class Quotation extends Model {
    public function getAllQuotations($limit, $offset, $sortField, $sortOrder, $filterTel, $filterStatus) {
        $sql = "SELECT * FROM quotation WHERE 1=1";

        if ($filterTel) {
            $sql .= " AND tel LIKE ?";
        }

        if ($filterStatus) {
            $sql .= " AND status = ?";
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

    public function getQuotationCount($filterTel, $filterStatus) {
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

    public function getQuotationById($id) {
        $stmt = $this->db->prepare("SELECT * FROM quotation WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $this->fetchAssoc($stmt)[0];
    }

    public function createQuotation($tel, $birth_date, $age, $duration, $status) {
        $stmt = $this->db->prepare("INSERT INTO quotation (tel, birth_date, age, duration, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssiss', $tel, $birth_date, $age, $duration, $status);
        return $stmt->execute();
    }

    public function updateQuotation($id, $tel, $birth_date, $age, $duration, $status) {
        $stmt = $this->db->prepare("UPDATE quotation SET tel = ?, birth_date = ?, age = ?, duration = ?, status = ? WHERE id = ?");
        $stmt->bind_param('ssissi', $tel, $birth_date, $age, $duration, $status, $id);
        return $stmt->execute();
    }

    public function deleteQuotation($id) {
        $stmt = $this->db->prepare("DELETE FROM quotation WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
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
?>
