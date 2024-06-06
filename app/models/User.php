<?php
class User extends Model {
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function createUser($data) {
        $stmt = $this->db->prepare("INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $data['username'], $data['password'], $data['email'], $data['role']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateUser($id, $data) {
        $stmt = $this->db->prepare("UPDATE user SET username = ?, password = ?, email = ?, role = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $data['username'], $data['password'], $data['email'], $data['role'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM user WHERE id = ?");
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
