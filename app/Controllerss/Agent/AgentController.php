<?php

namespace App\Controllers\Agent;

use Core\Controller;
use Core\View;

class AgentController extends Controller {
    public function dashboard() {
        $pagetitle = 'Agent Dashboard';
        $this->view('agent/dashboard', ['pagetitle' => $pagetitle], 'admin'); // Use 'admin' layout
    }

    // Add more agent-specific methods here
}
