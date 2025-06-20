<?php

namespace App\Controllers\Agent;

use Core\View;
use Core\Middleware;
use App\Models\Client;
use App\Models\Package;
use App\Models\Quotation;
use Exception;

class QuotationController
{
    protected $clientModel;
    protected $packageModel;
    protected $quotationModel;

    public function __construct()
    {
        $this->clientModel = new Client();
        $this->packageModel = new Package();
        $this->quotationModel = new Quotation();
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }

    public function create()
    {
        $agent_id = $_SESSION['user_id'];
        
        // Get clients for the current agent
        $clients = $this->clientModel->getClientsByAgent($agent_id);
        
        // Get available packages
        $packages = $this->packageModel->getAllPackages();

        return View::render('agent/quotations/create', [
            'clients' => $clients,
            'packages' => $packages
        ]);
    }

    public function store()
    {
        try {
            // Validate required fields
            $required_fields = ['client_id', 'age', 'duration', 'package_id'];
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception("$field is required");
                }
            }

            $data = [
                'client_id' => $_POST['client_id'],
                'agent_id' => $_SESSION['user_id'],
                'age' => $_POST['age'],
                'duration' => $_POST['duration'],
                'package_id' => $_POST['package_id'],
                'notes' => $_POST['notes'] ?? null,
                'status' => 'pending'
            ];

            // Create quotation
            $quotation_id = $this->quotationModel->createQuotation($data);

            if ($quotation_id) {
                $_SESSION['success'] = "Quotation created successfully";
                $this->redirect('/agent/quotations');
            } else {
                throw new Exception("Failed to create quotation");
            }

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->redirect('/agent/quotations/create');
        }
    }

    public function index()
    {
        $agent_id = $_SESSION['user_id'];
        $quotations = $this->quotationModel->getQuotationsByAgent($agent_id);

        return View::render('agent/quotations/index', [
            'quotations' => $quotations
        ], 'admin');
    }

    public function show($id)
    {
        $quotation = $this->quotationModel->getQuotationById($id);
        if (!$quotation) {
            $_SESSION['error'] = "Quotation not found";
            $this->redirect('/agent/quotations');
        }

        return View::render('agent/quotations/view', [
            'quotation' => $quotation
        ]);
    }
} 