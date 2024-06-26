<?php

namespace App\Models;

use Core\Model;

class Company extends Model
{
    public function getAllCompanies($onlyActive = true)
    {
        if ($onlyActive) {
            $stmt = $this->db->prepare("SELECT * FROM company WHERE is_active = 1 ORDER BY sort");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM company ORDER BY sort");
        }
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return $result;
    }

    public function getCompanyById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM company WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $this->fetchAssoc($stmt);
        $stmt->close();
        return !empty($result) ? $result[0] : null;
    }

    public function createCompany($data)
    {
        $stmt = $this->db->prepare("INSERT INTO company (logo, name, intro, shareholders, contract_file, tariffs_images, color, sort, is_active, icon) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $tariffs_images = json_encode($data['tariffs_images']);
        echo $tariffs_images;
        $stmt->bind_param(
            'ssssssssis',
            $data['logo'],
            $data['name'],
            $data['intro'],
            $data['shareholders'],
            $data['contract_file'],
            $tariffs_images,
            $data['color'],
            $data['sort'],
            $data['is_active'],
            $data['icon']
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateCompany($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE company SET logo = ?, name = ?, intro = ?, shareholders = ?, contract_file = ?, tariffs_images = ?, color = ?, sort = ?, is_active = ?, icon = ? WHERE id = ?");
        $tariffs_images = json_encode($data['tariffs_images']);
        $stmt->bind_param(
            'ssssssssisi',
            $data['logo'],
            $data['name'],
            $data['intro'],
            $data['shareholders'],
            $data['contract_file'],
            $tariffs_images,
            $data['color'],
            $data['sort'],
            $data['is_active'],
            $data['icon'],
            $id
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteCompany($id)
    {
        $stmt = $this->db->prepare("DELETE FROM company WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
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
