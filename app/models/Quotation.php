<?php
class Quotation extends Model {
    public function getAllQuotations() {
        $stmt = $this->db->prepare("SELECT * FROM quotation");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function createQuotation($data) {
        $stmt = $this->db->prepare("INSERT INTO quotation (tel, birth_date, age, duration) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssii', $data['tel'], $data['birth_date'], $data['age'], $data['duration']);
        return $stmt->execute();
    }
}
