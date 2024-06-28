<?php
namespace App\Controllers;

use App\Models\Company;
use Core\Controller;
use Core\View;

class CompanyController extends Controller
{
    public function getCompanyDetails($companyId)
    {
        $companyModel = new Company();
        $company = $companyModel->getCompanyById($companyId);

        if ($company) {
            echo json_encode([
                'name' => $company['name'],
                'intro' => $company['intro'],
                // Add other fields if necessary
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Company not found']);
        }
    }
}
