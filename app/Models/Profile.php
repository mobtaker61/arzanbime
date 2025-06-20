<?php

namespace App\Models;

use Core\Model;
use Core\Database;
use Exception;
use DateTime;

class Profile extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
    }

    // Profile properties
    private int $id;
    private int $userId;
    private ?string $profileImage;
    private string $name;
    private string $surname;
    private ?string $birthDate;
    private string $email;
    private string $phone;
    private bool $isVerified;

    /**
     * Get profile by user ID
     *
     * @param int $userId User ID
     * @return array|null Profile data or null if not found
     * @throws Exception If the database query fails
     */
    public function getProfileByUserId(int $userId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM profiles WHERE user_id = ? LIMIT 1");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return !empty($result) ? $result : null;
    }

    /**
     * Get profile by phone number
     *
     * @param string $phone Phone number
     * @return array|null Profile data or null if not found
     * @throws Exception If the database query fails
     */
    public function getProfileByPhone(string $phone): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM profiles WHERE phone = ? LIMIT 1");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('s', $phone);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get profile by email
     *
     * @param string $email Email address
     * @return array|null Profile data or null if not found
     * @throws Exception If the database query fails
     */
    public function getProfileByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM profiles WHERE email = ? LIMIT 1");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Create a new profile
     *
     * @param array $data Profile data
     * @return bool Success status
     * @throws Exception If the database query fails
     */
    public function createProfile(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO profiles (user_id, name, surname, birth_date, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $stmt->bind_param('isssss', 
            $data['user_id'],
            $data['name'],
            $data['surname'],
            $data['birth_date'],
            $data['email'],
            $data['phone']
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Update a profile
     *
     * @param int $userId User ID
     * @param array $data Profile data
     * @return bool Success status
     * @throws Exception If the database query fails
     */
    public function updateProfile(int $userId, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE profiles SET name = ?, surname = ?, birth_date = ?, email = ?, phone = ? WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $stmt->bind_param('sssssi',
            $data['name'],
            $data['surname'],
            $data['birth_date'],
            $data['email'],
            $data['phone'],
            $userId
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    /**
     * Delete a profile
     *
     * @param int $userId User ID
     * @return bool Success status
     * @throws Exception If the database query fails
     */
    public function deleteProfile(int $userId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM profiles WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('i', $userId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Get user profiles with upcoming birthdays
     *
     * @param string $startDate Start date in Y-m-d format
     * @param string $endDate End date in Y-m-d format
     * @return array Profiles with upcoming birthdays
     */
    public function getProfilesWithUpcomingBirthdays(string $startDate, string $endDate): array
    {
        $stmt = $this->db->prepare("SELECT p.*, u.username
            FROM profiles p 
            LEFT JOIN users u ON p.user_id = u.id
            WHERE DATE_FORMAT(p.birth_date, '%m-%d') BETWEEN DATE_FORMAT(?, '%m-%d') AND DATE_FORMAT(?, '%m-%d') 
            ORDER BY DATE_FORMAT(p.birth_date, '%m-%d')");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    /**
     * Calculate user age
     *
     * @param string $birthDate Birth date in Y-m-d format
     * @return int|null Age in years or null if birth date is invalid
     */
    public function calculateAge(?string $birthDate): ?int
    {
        if (empty($birthDate)) {
            return null;
        }
        
        try {
            $birth = new DateTime($birthDate);
            $today = new DateTime();
            return $today->diff($birth)->y;
        } catch (Exception $e) {
            return null;
        }
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
}
