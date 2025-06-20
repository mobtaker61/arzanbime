<?php

namespace App\Models;

use Core\Model;
use Core\Database;
use Exception;

class Client extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
    }

    public function getClientsByAgent($agent_id)
    {
        $sql = "SELECT c.* 
                FROM clients c 
                JOIN agent_clients ac ON c.id = ac.client_id
                WHERE ac.agent_id = ?
                ORDER BY c.name ASC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error());
        }

        $stmt->bind_param('i', $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $clients = [];
        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }
        
        $stmt->close();
        return $clients;
    }

    public function createClient($data)
    {
        // Start transaction
        $this->db->begin_transaction();

        try {
            // Insert into clients table
            $stmt = $this->db->prepare("INSERT INTO clients (id_no, name, family, birth_date, phone) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception($this->db->error());
            }

            $stmt->bind_param('sssss', 
                $data['id_no'],
                $data['name'],
                $data['family'],
                $data['birth_date'],
                $data['phone']
            );

            $stmt->execute();
            $clientId = $stmt->insert_id;
            $stmt->close();

            if ($clientId) {
                // Create agent-client relationship
                $agentClientStmt = $this->db->prepare("INSERT INTO agent_clients (agent_id, client_id) VALUES (?, ?)");
                if (!$agentClientStmt) {
                    throw new Exception($this->db->error());
                }

                $agentClientStmt->bind_param('ii',
                    $data['agent_id'],
                    $clientId
                );

                $agentClientStmt->execute();
                $agentClientStmt->close();

                // Commit transaction
                $this->db->commit();
                return $clientId;
            }

            throw new Exception("Failed to create client");

        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->rollback();
            throw $e;
        }
    }

    public function updateClient($id, $data)
    {
        // Start transaction
        $this->db->begin_transaction();

        try {
            // Update clients table
            $stmt = $this->db->prepare("UPDATE clients SET id_no = ?, name = ?, family = ?, birth_date = ?, phone = ? WHERE id = ?");
            if (!$stmt) {
                throw new Exception($this->db->error());
            }

            $stmt->bind_param('sssssi',
                $data['id_no'],
                $data['name'],
                $data['family'],
                $data['birth_date'],
                $data['phone'],
                $id
            );

            $result = $stmt->execute();
            $stmt->close();

            if ($result) {
                // Commit transaction
                $this->db->commit();
                return true;
            }

            throw new Exception("Failed to update client");

        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->rollback();
            throw $e;
        }
    }

    public function getClientById($id)
    {
        $sql = "SELECT * FROM clients WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->db->error());
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $client = $result->fetch_assoc();
        $stmt->close();

        return $client;
    }

    public function deleteClient($id)
    {
        // Start transaction
        $this->db->begin_transaction();

        try {
            // Delete from agent_clients first (due to foreign key constraints)
            $agentClientStmt = $this->db->prepare("DELETE FROM agent_clients WHERE client_id = ?");
            if (!$agentClientStmt) {
                throw new Exception($this->db->error());
            }

            $agentClientStmt->bind_param('i', $id);
            $agentClientStmt->execute();
            $agentClientStmt->close();

            // Delete client
            $stmt = $this->db->prepare("DELETE FROM clients WHERE id = ?");
            if (!$stmt) {
                throw new Exception($this->db->error());
            }

            $stmt->bind_param('i', $id);
            $result = $stmt->execute();
            $stmt->close();

            // Commit transaction
            $this->db->commit();
            return $result;

        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->rollback();
            throw $e;
        }
    }
} 