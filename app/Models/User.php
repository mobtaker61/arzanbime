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
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role, user_level_id, is_active) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssii', $data['username'], $data['password'], $data['role'], $data['user_level_id'], $data['is_active']);
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
        $stmt = $this->db->prepare("SELECT u.id, u.username, u.user_level_id, p.name, p.surname, p.birth_date
            FROM users u 
            LEFT JOIN profiles p ON u.id = p.user_id");
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();

        foreach ($result as &$user) {
            if (!empty($user['birth_date'])) {
                $birthDate = new \DateTime($user['birth_date']);
                $today = new \DateTime();
                $age = $today->diff($birthDate)->y;
                $user['age'] = $age;
            } else {
                $user['age'] = null;
            }
        }

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

    public function getUsersByRole($role, $search = '', $limit = 10, $offset = 0)
    {
        $search = "%$search%";
        $stmt = $this->db->prepare("SELECT users.*, profiles.name, profiles.surname, profiles.email, profiles.phone, user_levels.name as user_level FROM users 
            LEFT JOIN profiles ON users.id = profiles.user_id 
            LEFT JOIN user_levels ON users.user_level_id = user_levels.id
            WHERE role = ? AND (users.username LIKE ? OR profiles.name LIKE ? OR profiles.surname LIKE ? OR profiles.email LIKE ? OR profiles.phone LIKE ?)
            LIMIT ? OFFSET ?");
        $stmt->bind_param('ssssssii', $role, $search, $search, $search, $search, $search, $limit, $offset);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getUserCountByRole($role, $search = '')
    {
        $search = "%$search%";
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM users 
            LEFT JOIN profiles ON users.id = profiles.user_id 
            WHERE role = ? AND (users.username LIKE ? OR profiles.name LIKE ? OR profiles.surname LIKE ? OR profiles.email LIKE ? OR profiles.phone LIKE ?)");
        $stmt->bind_param('ssssss', $role, $search, $search, $search, $search, $search);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }

    public function getAdminUsers()
    {
        $stmt = $this->db->prepare("SELECT id, username FROM users WHERE role = 'admin'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function getOperators()
    {
        $stmt = $this->db->prepare("SELECT id, username FROM users WHERE role != 'user'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function createUser($data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $data['username'], $data['password'], $data['role']);
        $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();
        return $userId;
    }

    public function updateUser($id, $data)
    {
        $query = "UPDATE users SET username = ?, role = ?, user_level_id = ?, is_active = ?";
        $types = 'ssii';
        $params = [$data['username'], $data['role'], $data['user_level_id'], $data['is_active']];

        if (isset($data['password'])) {
            $query .= ", password = ?";
            $types .= 's';
            $params[] = $data['password'];
        }

        $query .= " WHERE id = ?";
        $types .= 'i';
        $params[] = $id;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $stmt->close();
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
