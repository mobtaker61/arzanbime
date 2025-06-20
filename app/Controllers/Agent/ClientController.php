<?php

namespace App\Controllers\Agent;

use Core\View;
use Core\Middleware;
use App\Models\Client;
use Exception;

class ClientController
{
    public function __construct()
    {
        Middleware::auth();
        Middleware::agent();
    }

    public function store()
    {
        try {
            $agent_id = $_SESSION['user_id'];
            
            // Validate required fields
            $requiredFields = ['id_no', 'name', 'family', 'birth_date', 'phone'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception("فیلد {$field} الزامی است");
                }
            }

            // Prepare client data
            $clientData = [
                'agent_id' => $agent_id,
                'id_no' => $_POST['id_no'],
                'birth_date' => $_POST['birth_date'],
                'name' => $_POST['name'],
                'family' => $_POST['family'],
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone']
            ];

            // Create client
            $clientModel = new Client();
            $clientId = $clientModel->createClient($clientData);

            if (!$clientId) {
                throw new Exception("خطا در ایجاد مشتری");
            }

            // Calculate age
            $birthDate = new \DateTime($clientData['birth_date']);
            $today = new \DateTime();
            $age = $today->diff($birthDate)->y;

            // Return success response
            echo json_encode([
                'success' => true,
                'message' => 'مشتری با موفقیت ایجاد شد',
                'client' => [
                    'id' => $clientId,
                    'name' => $clientData['name'],
                    'family' => $clientData['family'],
                    'id_no' => $clientData['id_no'],
                    'age' => $age
                ]
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
} 