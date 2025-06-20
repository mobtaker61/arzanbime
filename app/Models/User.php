<?php

namespace App\Models;

use Core\Model;
use Exception;
use PDO;
use DateTime;

class User extends Model
{
    // User properties
    private int $id;
    private string $username;
    private string $password;
    private string $role;
    private int $userLevelId;
    private bool $isActive;
    private ?string $resetToken;
    private array $debugInfo = [];
    
    // Constants for user roles
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_AGENT = 'agent';
    
    /**
     * Attempt to login a user
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Whether login was successful
     */
    public function login(string $username, string $password): bool
    {
        $this->debugInfo = [];
        $this->debugInfo[] = "Attempting login for user: " . $username;
        
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Clear any existing session data
        session_unset();
        
        try {
            // First, check if the user exists
            $sql = "SELECT * FROM users WHERE username = ? AND is_active = 1 LIMIT 1";
            $this->debugInfo[] = "Executing SQL: " . $sql;
            
            $stmt = $this->db->prepare($sql);
            if (!$stmt) {
                $this->debugInfo[] = "Prepare failed: " . $this->db->error;
                return false;
            }
            
            $stmt->bind_param('s', $username);
            if (!$stmt->execute()) {
                $this->debugInfo[] = "Execute failed: " . $stmt->error;
                $stmt->close();
                return false;
            }
            
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();
            
            if (!$user) {
                $this->debugInfo[] = "No user found with username: " . $username;
                return false;
            }
            
            $this->debugInfo[] = "User found with ID: " . $user['id'];
            
            // Verify password
            if (!password_verify($password, $user['password'])) {
                $this->debugInfo[] = "Password verification failed";
                return false;
            }
            
            $this->debugInfo[] = "Password verified successfully";
            
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['role'];
            
            $this->debugInfo[] = "Session variables set. User ID: " . $_SESSION['user_id'] . ", Role: " . $_SESSION['user_role'];
            
            return true;
        } catch (Exception $e) {
            $this->debugInfo[] = "Exception occurred: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Register a new user
     *
     * @param array $data User data
     * @return int The ID of the newly created user
     */
    public function register(array $data): int
    {
        // Hash the password for security
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $isActive = $data['is_active'] ?? 1;
        $userLevelId = $data['user_level_id'] ?? 1;
        $fcmToken = $data['fcm_token'] ?? '';
        
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role, user_level_id, is_active, fcm_token) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssiss', $data['username'], $hashedPassword, $data['role'], $userLevelId, $isActive, $fcmToken);
        $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();
        
        return $userId;
    }

    /**
     * Check if username, tel, or email already exists
     *
     * @param string $username Username to check
     * @param string $tel Phone number to check
     * @param string $email Email to check
     * @return bool True if any exists, false otherwise
     * @throws Exception
     */
    public function isUsernameOrTelExists(string $username, string $tel, string $email): bool
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

    /**
     * Get the current user's role
     *
     * @return string|null The user's role
     */
    public function getRole(): ?string
    {
        return $_SESSION['user_role'] ?? null;
    }

    /**
     * Log the user out
     */
    public function logout(): void
    {
        session_unset();
        session_destroy();
    }

    /**
     * Generate a password reset token for a user
     *
     * @param string $email The user's email
     * @return string|false The reset token or false if user not found
     */
    public function generatePasswordResetToken(string $email)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            $token = bin2hex(random_bytes(16));
            $stmt = $this->db->prepare("UPDATE users SET reset_token = ? WHERE id = ?");
            $stmt->bind_param('si', $token, $user['id']);
            $stmt->execute();
            $stmt->close();
            return $token;
        }
        
        return false;
    }

    /**
     * Reset a user's password using a token
     *
     * @param string $token Reset token
     * @param string $newPassword New password
     * @return bool Success status
     */
    public function resetPassword(string $token, string $newPassword): bool
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE reset_token = ?");
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE id = ?");
            $stmt->bind_param('si', $passwordHash, $user['id']);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        
        return false;
    }

    /**
     * Check if user is logged in
     *
     * @return bool User login status
     */
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Get all users with optional role filter
     *
     * @param string|null $role Role to filter by
     * @return array Users data
     */
    public function getAllUsers(?string $role = null): array
    {
        // Base SQL query
        $sql = "SELECT u.id, u.username, u.user_level_id, p.name, p.surname, p.birth_date
            FROM users u 
            LEFT JOIN profiles p ON u.id = p.user_id";

        // Add role condition if provided
        if ($role !== null) {
            $sql .= " WHERE u.role = ?";
        }

        $sql .= " ORDER BY p.name";

        // Prepare query
        $stmt = $this->db->prepare($sql);

        // Bind role parameter if provided
        if ($role !== null) {
            $stmt->bind_param('s', $role);
        }

        // Execute query
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();

        // Calculate users' ages
        foreach ($result as &$user) {
            if (!empty($user['birth_date'])) {
                $birthDate = new DateTime($user['birth_date']);
                $today = new DateTime();
                $age = $today->diff($birthDate)->y;
                $user['age'] = $age;
            } else {
                $user['age'] = null;
            }
        }

        return $result;
    }

    /**
     * Get user by ID
     *
     * @param int $id User ID
     * @return array|null User data or null if not found
     */
    public function getUserById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get user by username
     *
     * @param string $username Username to search for
     * @return array|null User data or null if not found
     */
    public function getUserByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get users by role with search and pagination
     *
     * @param string $role Role to filter by
     * @param string $search Search term
     * @param int $limit Results per page
     * @param int $offset Pagination offset
     * @return array Users data
     */
    public function getUsersByRole(string $role, string $search = '', int $limit = 10, int $offset = 0): array
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

    /**
     * Get count of users by role with search
     *
     * @param string $role Role to filter by
     * @param string $search Search term
     * @return int User count
     */
    public function getUserCountByRole(string $role, string $search = ''): int
    {
        $search = "%$search%";
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM users 
            LEFT JOIN profiles ON users.id = profiles.user_id 
            WHERE role = ? AND (users.username LIKE ? OR profiles.name LIKE ? OR profiles.surname LIKE ? OR profiles.email LIKE ? OR profiles.phone LIKE ?)");
        $stmt->bind_param('ssssss', $role, $search, $search, $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['count'] ?? 0;
    }

    /**
     * Get user balance
     *
     * @param int $userId User ID
     * @return float User balance
     */
    public function getUserBalance(int $userId): float
    {
        $stmt = $this->db->prepare("SELECT SUM(amount) as balance FROM user_transactions WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return (float)($result['balance'] ?? 0);
    }

    /**
     * Get admin users
     *
     * @return array Admin users data
     */
    public function getAdminUsers(): array
    {
        return $this->getAllUsers(self::ROLE_ADMIN);
    }

    /**
     * Create a new user
     *
     * @param array $data User data
     * @return int New user ID
     */
    public function createUser(array $data): int
    {
        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $fcmToken = $data['fcm_token'] ?? '';
        
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role, user_level_id, is_active, fcm_token) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssiss', 
            $data['username'], 
            $hashedPassword, 
            $data['role'], 
            $data['user_level_id'], 
            $data['is_active'],
            $fcmToken
        );
        $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();
        return $userId;
    }

    /**
     * Update user data
     *
     * @param int $id User ID
     * @param array $data User data
     * @return bool Success status
     */
    public function updateUser(int $id, array $data): bool
    {
        // Update password only if provided
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ?, role = ?, user_level_id = ?, is_active = ?, fcm_token = ? WHERE id = ?");
            $stmt->bind_param('sssiisi', 
                $data['username'], 
                $data['password'], 
                $data['role'], 
                $data['user_level_id'], 
                $data['is_active'],
                $data['fcm_token'] ?? '',
                $id
            );
        } else {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, role = ?, user_level_id = ?, is_active = ?, fcm_token = ? WHERE id = ?");
            $stmt->bind_param('ssiisi', 
                $data['username'], 
                $data['role'], 
                $data['user_level_id'], 
                $data['is_active'],
                $data['fcm_token'] ?? '',
                $id
            );
        }
        
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Delete a user
     *
     * @param int $id User ID
     * @return bool Success status
     */
    public function deleteUser(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Get user level
     *
     * @param int $userId User ID
     * @return array|null User level data
     */
    public function getUserLevel(int $userId): ?array
    {
        $stmt = $this->db->prepare("SELECT ul.* FROM user_levels ul 
                                    JOIN users u ON u.user_level_id = ul.id 
                                    WHERE u.id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get debug info
     *
     * @return array Debug information
     */
    public function getDebugInfo(): array
    {
        return $this->debugInfo;
    }

    /**
     * Fetch associated results from a statement
     *
     * @param mixed $stmt Database statement
     * @return array Result set
     */
    private function fetchAssoc($stmt): array
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

    /**
     * Get users with upcoming birthdays
     *
     * @param string $startDate Start date in Y-m-d format
     * @param string $endDate End date in Y-m-d format
     * @return array Users with upcoming birthdays
     */
    public function getUsersWithUpcomingBirthdays(string $startDate, string $endDate): array
    {
        $stmt = $this->db->prepare("SELECT u.id, u.username, p.name, p.surname, p.birth_date, p.phone
            FROM users u 
            LEFT JOIN profiles p ON u.id = p.user_id
            WHERE DATE_FORMAT(p.birth_date, '%m-%d') BETWEEN DATE_FORMAT(?, '%m-%d') AND DATE_FORMAT(?, '%m-%d') 
            ORDER BY DATE_FORMAT(p.birth_date, '%m-%d')");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        
        // Calculate age for each user
        foreach ($result as &$user) {
            if (!empty($user['birth_date'])) {
                $birth = new DateTime($user['birth_date']);
                $today = new DateTime();
                $user['age'] = $today->diff($birth)->y;
                
                // Calculate days until next birthday
                $birthMonth = $birth->format('m');
                $birthDay = $birth->format('d');
                $nextBirthday = new DateTime(date('Y') . '-' . $birthMonth . '-' . $birthDay);
                
                if ($nextBirthday < new DateTime()) {
                    $nextBirthday->modify('+1 year');
                }
                
                $daysUntilBirthday = $today->diff($nextBirthday)->days;
                $user['days_until_birthday'] = $daysUntilBirthday;
            }
        }
        
        return $result;
    }

    /**
     * Get the count of sub-users (clients) for a specific agent
     *
     * @param int $agentId The agent's user ID
     * @return int The count of sub-users
     */
    public function getSubUsersCountByAgent(int $agentId): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM user_clients WHERE user_id = ?");
        $stmt->bind_param('i', $agentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return (int) $row['count'];
    }

    /**
     * Get the account balance for a specific agent by calculating from transactions
     *
     * @param int $agentId The agent's user ID
     * @return float The agent's account balance
     */
    public function getAgentBalance(int $agentId): float
    {
        $stmt = $this->db->prepare("
            SELECT 
                COALESCE(SUM(credit - debit), 0) as balance 
            FROM transactions 
            WHERE user_id = ?");
        $stmt->bind_param('i', $agentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return (float) ($row['balance'] ?? 0);
    }

    /**
     * Get the user level ID for a specific user
     *
     * @param int $userId The user's ID
     * @return int The user's level ID
     */
    public function getUserLevelId(int $userId): int
    {
        $stmt = $this->db->prepare("SELECT user_level_id FROM users WHERE id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return (int) ($row['user_level_id'] ?? 0);
    }

    /**
     * Get sub-users with upcoming birthdays for a specific agent
     * Shows birthdays from 3 days before to 7 days after today
     *
     * @param int $agentId The agent's user ID
     * @return array Array of users with upcoming birthdays
     */
    public function getSubUsersWithUpcomingBirthdays(int $agentId): array
    {
        $sql = "SELECT u.id, p.name, p.surname, p.birth_date, p.phone,
                       TIMESTAMPDIFF(YEAR, p.birth_date, CURDATE()) as age,
                       DATE_FORMAT(p.birth_date, '%m-%d') as birthday,
                       DATE_FORMAT(CURDATE(), '%m-%d') as today
                FROM users u
                JOIN profiles p ON u.id = p.user_id
                JOIN user_clients uc ON u.id = uc.client_id
                WHERE uc.user_id = ?
                HAVING (
                    (
                        birthday BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 DAY), '%m-%d')
                        AND DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d')
                    )
                    OR (
                        birthday BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 DAY), '%m-%d')
                        AND '12-31'
                        AND today BETWEEN '01-01' AND '01-07'
                    )
                    OR (
                        birthday BETWEEN '01-01'
                        AND DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d')
                        AND today BETWEEN '12-22' AND '12-31'
                    )
                )
                ORDER BY 
                    CASE 
                        WHEN birthday >= DATE_FORMAT(CURDATE(), '%m-%d') THEN 0 
                        ELSE 1 
                    END,
                    birthday";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $agentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        
        $stmt->close();
        return $users;
    }

    public function getUsersByAgent($agent_id)
    {
        $sql = "SELECT u.*, p.name, p.surname, p.email, p.phone 
                FROM users u 
                LEFT JOIN profiles p ON u.id = p.user_id 
                JOIN user_clients uc ON u.id = uc.client_id
                WHERE uc.user_id = ? AND u.role = 'user'
                ORDER BY p.name ASC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $stmt->bind_param('i', $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        
        $stmt->close();
        return $users;
    }
}
