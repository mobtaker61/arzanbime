<?php
class User extends Model {
    public function register($username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $email, $passwordHash);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();

        if (!empty($result)) {
            $user = $result[0];
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
    }

    public function generatePasswordResetToken($email) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();

        if (!empty($result)) {
            $user = $result[0];
            $token = bin2hex(random_bytes(16));
            $stmt = $this->db->prepare("UPDATE users SET reset_token = ? WHERE id = ?");
            $stmt->bind_param('si', $token, $user['id']);
            $stmt->execute();
            return $token;
        }
        return false;
    }

    public function resetPassword($token, $newPassword) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE reset_token = ?");
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();

        if (!empty($result)) {
            $user = $result[0];
            $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE id = ?");
            $stmt->bind_param('si', $passwordHash, $user['id']);
            return $stmt->execute();
        }
        return false;
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function createUser($data) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $data['username'], $data['password'], $data['email'], $data['role']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateUser($id, $data) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ?, email = ?, role = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $data['username'], $data['password'], $data['email'], $data['role'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
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
