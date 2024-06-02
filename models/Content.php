<?php
class Content {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllContents() {
        $sql = "SELECT * FROM contents ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getContentById($id) {
        $sql = "SELECT * FROM contents WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
