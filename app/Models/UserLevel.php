<?php
namespace App\Models;

use Core\Model;
use Exception;

class UserLevel extends Model {
    // Properties
    private int $id;
    private string $name;
    private string $color;
    private int $minValue;
    private int $maxValue;

    /**
     * Get all user levels
     * 
     * @return array All user levels
     */
    public function getAllUserLevels(): array {
        $stmt = $this->db->prepare("SELECT * FROM user_levels ORDER BY min_value");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    /**
     * Get user level by ID
     * 
     * @param int $id User level ID
     * @return array|null User level data or null if not found
     */
    public function getUserLevelById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM user_levels WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Create a new user level
     * 
     * @param array $data User level data
     * @return bool Success status
     * @throws Exception If the database query fails
     */
    public function createUserLevel(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO user_levels (name, color, min_value, max_value) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('ssii', $data['name'], $data['color'], $data['min_value'], $data['max_value']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Update a user level
     * 
     * @param int $id User level ID
     * @param array $data User level data
     * @return bool Success status
     * @throws Exception If the database query fails
     */
    public function updateUserLevel(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE user_levels SET name = ?, color = ?, min_value = ?, max_value = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('ssiii', $data['name'], $data['color'], $data['min_value'], $data['max_value'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Delete a user level
     * 
     * @param int $id User level ID
     * @return bool Success status
     * @throws Exception If the database query fails
     */
    public function deleteUserLevel(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM user_levels WHERE id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Get user level by range
     * 
     * @param int $value Value to check against min_value and max_value
     * @return array|null User level data or null if not found
     */
    public function getUserLevelByRange(int $value): ?array {
        $stmt = $this->db->prepare("SELECT * FROM user_levels WHERE min_value <= ? AND max_value >= ? LIMIT 1");
        $stmt->bind_param('ii', $value, $value);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get users by level
     * 
     * @param int $levelId Level ID
     * @return array Users with the specified level
     */
    public function getUsersByLevel(int $levelId): array {
        $stmt = $this->db->prepare("SELECT u.*, p.name, p.surname, p.email, p.phone 
                                    FROM users u 
                                    LEFT JOIN profiles p ON u.id = p.user_id
                                    WHERE u.user_level_id = ?");
        $stmt->bind_param('i', $levelId);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    /**
     * Fetch associated results from a statement
     * 
     * @param mixed $stmt Database statement
     * @return array Result set
     */
    private function fetchAssoc($stmt): array {
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
