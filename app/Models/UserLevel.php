<?php
namespace App\Models;

use Core\Model;

class UserLevel extends Model {
    public function getAllUserLevels() {
        $stmt = $this->db->prepare("SELECT * FROM user_levels");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getUserLevelById($id) {
        $stmt = $this->db->prepare("SELECT * FROM user_levels WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function createUserLevel($data) {
        $stmt = $this->db->prepare("INSERT INTO user_levels (name, color, min_value, max_value) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssii', $data['name'], $data['color'], $data['min_value'], $data['max_value']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateUserLevel($id, $data) {
        $stmt = $this->db->prepare("UPDATE user_levels SET name = ?, color = ?, min_value = ?, max_value = ? WHERE id = ?");
        $stmt->bind_param('ssiii', $data['name'], $data['color'], $data['min_value'], $data['max_value'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteUserLevel($id) {
        $stmt = $this->db->prepare("DELETE FROM user_levels WHERE id = ?");
        $stmt->bind_param('i', $id);
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
