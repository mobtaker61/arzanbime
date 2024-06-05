<?php
class Office {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getOfficesByProvinceId($province_id) {
        $sql = "SELECT id, name, postal_address, telephone, email, google_location FROM offices WHERE province_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $province_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $postal_address, $telephone, $email, $google_location);
        $results = [];
        while ($stmt->fetch()) {
            $results[] = [
                'id' => $id,
                'name' => $name,
                'postal_address' => $postal_address,
                'telephone' => $telephone,
                'email' => $email,
                'google_location' => $google_location,
            ];
        }
        $stmt->close();
        return $results;
    }

    public function getAllProvinces() {
        $sql = "SELECT id, name FROM provinces";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
