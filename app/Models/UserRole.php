<?php

namespace App\Models;

use Core\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';
    
    public function getAllRoles()
    {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->db->query($sql);
        $roles = [];
        
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row;
        }
        
        return $roles;
    }
    
    public function getRoleById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
} 