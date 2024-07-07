<?php

namespace App\Models;

use Core\Model;
use Exception;

class User extends Model
{
    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND is_active = 1 LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            // Ensure session start
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function register($data)
    {
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role, is_active) VALUES (?, ?, ?, 1)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('sss', $data['username'], $hashedPassword, $data['role']);
        $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();

        return $userId;
    }

    public function isUsernameOrTelExists($username, $tel, $email)
    {
        // Check username in users table
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $userExists = $stmt->num_rows > 0;
        $stmt->close();
        // Check email or phone in profiles table
        $stmt = $this->db->prepare("SELECT id FROM profiles WHERE phone = ? OR email = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('ss', $tel, $email);
        $stmt->execute();
        $stmt->store_result();
        $profileExists = $stmt->num_rows > 0;
        $stmt->close();

        return $userExists || $profileExists;
    }

    public function getRole()
    {
        return $_SESSION['role'] ?? null;
    }

    public function logout()
    {
        // Ensure session start
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
    }

    public function generatePasswordResetToken($email)
    {
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

    public function resetPassword($token, $newPassword)
    {
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

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function getAdminUsers()
    {
        $stmt = $this->db->prepare("SELECT id, username FROM users WHERE role = 'admin'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function createUser($data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $data['username'], $data['password'], $data['email'], $data['role']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateUser($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param('sssi', $data['username'], $data['password'],  $data['role'], $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getUserLevel($userId)
    {
        $stmt = $this->db->prepare("SELECT ul.* FROM users u JOIN user_levels ul ON u.user_level_id = ul.id WHERE u.id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    private function fetchAssoc($stmt)
    {
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
