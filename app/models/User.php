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
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($id, $username, $email, $password = null) {
        if ($password) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param('sssi', $username, $email, $passwordHash, $id);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            $stmt->bind_param('ssi', $username, $email, $id);
        }
        return $stmt->execute();
    }

    public function generatePasswordResetToken($email) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user) {
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
        $user = $stmt->get_result()->fetch_assoc();

        if ($user) {
            $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE id = ?");
            $stmt->bind_param('si', $passwordHash, $user['id']);
            return $stmt->execute();
        }
        return false;
    }
}
