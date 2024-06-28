<?php

namespace App\Models;

use Core\Model;
use Exception;

class Profile extends Model
{
    public function getProfileByUserId($userId)
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

    public function getProfileByPhone($tel)
    {
        $stmt = $this->db->prepare("SELECT * FROM profiles WHERE phone = ? LIMIT 1");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('s', $tel);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result : null;
    }

    public function createProfile($data)
    {
        $stmt = $this->db->prepare("INSERT INTO profiles (user_id, profile_image, name, surname, birth_date, email, phone, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param(
            'issssssi',
            $data['user_id'],
            $data['profile_image'],
            $data['name'],
            $data['surname'],
            $data['birth_date'],
            $data['email'],
            $data['phone'],
            $data['is_verified']
        );
        $stmt->execute();
        $stmt->close();
    }

    public function updateProfile($userId, $data)
    {
        $stmt = $this->db->prepare("UPDATE profiles SET profile_image = ?, name = ?, surname = ?, birth_date = ?, email = ?, phone = ?, is_verified = ? WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
        $stmt->bind_param('ssssssii', $data['profile_image'], $data['name'], $data['surname'], $data['birth_date'], $data['email'], $data['phone'], $data['is_verified'], $userId);
        $stmt->execute();
        $stmt->close();
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
