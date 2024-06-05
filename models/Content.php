<?php
class Content {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllContents() {
        $sql = "SELECT id, title, body, type, image, created_at FROM contents";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestHelpContents($limit) {
        $sql = "SELECT id, title, body, type, image, created_at FROM contents WHERE type='help' ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        
        $stmt->bind_result($id, $title, $body, $type, $image, $created_at);
        $results = [];
        while ($stmt->fetch()) {
            $results[] = [
                'id' => $id,
                'title' => $title,
                'body' => $body,
                'type' => $type,
                'image' => $image,
                'created_at' => $created_at,
            ];
        }
        $stmt->close();
        return $results;
    }

    public function getContentById($id) {
        $sql = "SELECT id, title, body, type, image, created_at FROM contents WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt->bind_result($id, $title, $body, $type, $image, $created_at);
        $stmt->fetch();
        $result = [
            'id' => $id,
            'title' => $title,
            'body' => $body,
            'type' => $type,
            'image' => $image,
            'created_at' => $created_at,
        ];
        $stmt->close();
        return $result;
    }
}
?>
