<?php
namespace App\Models;

use Core\Model;
use Exception;

class ContactSubmission extends Model {
    public function saveSubmission($name, $email, $cell, $message) {
        try {
            $status = 'new';
            $stmt = $this->db->prepare("INSERT INTO contact_submissions (name, email, cell, message, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $name, $email, $cell, $message, $status);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateStatus($id, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE contact_submissions SET status = ? WHERE id = ?");
            $stmt->bind_param('si', $status, $id);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getSubmissionById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM contact_submissions WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllSubmissions() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM contact_submissions ORDER BY submitted_at DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
}
