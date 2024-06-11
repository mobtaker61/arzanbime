<?php
class Followup extends Model {
    public function getFollowupsByQuotationId($quotationId) {
        $stmt = $this->db->prepare("SELECT * FROM followup WHERE quotation_id = ? ORDER BY date DESC");
        $stmt->bind_param('i', $quotationId);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function createFollowup($quotationId, $date, $responsibleUser, $comment, $referTo, $isClosed) {
        $stmt = $this->db->prepare("INSERT INTO followup (quotation_id, date, responsible_user, comment, refer_to, is_closed) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issssi', $quotationId, $date, $responsibleUser, $comment, $referTo, $isClosed);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
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
