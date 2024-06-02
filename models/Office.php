<?php
class Office {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getOfficesByProvinceId($province_id) {
        $sql = "SELECT o.id, o.name, o.postal_address, o.telephone, o.email, o.google_location, p.name AS province_name 
                FROM offices o
                JOIN provinces p ON o.province_id = p.id
                WHERE o.province_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $province_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllProvinces() {
        $sql = "SELECT * FROM provinces";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
