<?php

namespace App\Controllers\Agent;

use App\Models\Order;
use App\Models\Quotation;
use App\Models\User;
use App\Models\PackageDiscount;
use App\Models\Transaction;
use Core\Controller;
use Core\View;

class AgentController extends Controller {
    public function dashboard() {
        // Get agent's user ID
        $agentId = $_SESSION['user_id'];
        
        // Get orders count for this agent
        $orderModel = new Order();
        $ordersCount = $orderModel->getOrdersCountByAgent($agentId);
        
        // Get recent orders for this agent
        $recentOrders = $orderModel->getRecentOrdersByAgent($agentId);
        
        // Get quotations count for this agent
        $quotationModel = new Quotation();
        $quotationsCount = $quotationModel->getQuotationsCountByAgent($agentId);
        
        // Get recent quotations for this agent
        $recentQuotations = $quotationModel->getRecentQuotationsByAgent($agentId);
        
        // Get sub-users count for this agent
        $userModel = new User();
        $subUsersCount = $userModel->getSubUsersCountByAgent($agentId);
        
        // Get account balance for this agent
        $accountBalance = $userModel->getAgentBalance($agentId);

        // Get agent's package discounts based on their user level
        $packageDiscountModel = new PackageDiscount();
        $userLevelId = $userModel->getUserLevelId($agentId);
        $packageDiscounts = $packageDiscountModel->getPackageDiscountsByUserLevel($userLevelId);

        // Get sub-users with upcoming birthdays
        $usersWithUpcomingBirthdays = $userModel->getSubUsersWithUpcomingBirthdays($agentId);
        
        // Get orders expiring in the next 70 days
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime("+70 days"));
        $ordersExpiringSoon = $orderModel->getOrdersByAgentAndDateRange($agentId, $startDate, $endDate);
        
        // Get latest transactions for this agent
        $transactionModel = new Transaction();
        $latestTransactions = $transactionModel->getLatestTransactionsByAgent($agentId);
        
        View::render('agent/dashboard', [
            'pagetitle' => 'داشبورد نماینده',
            'ordersCount' => $ordersCount,
            'quotationsCount' => $quotationsCount,
            'subUsersCount' => $subUsersCount,
            'accountBalance' => $accountBalance,
            'recentOrders' => $recentOrders,
            'recentQuotations' => $recentQuotations,
            'packageDiscounts' => $packageDiscounts,
            'usersWithUpcomingBirthdays' => $usersWithUpcomingBirthdays,
            'ordersExpiringSoon' => $ordersExpiringSoon,
            'latestTransactions' => $latestTransactions
        ], 'admin');
    }

    // Add more agent-specific methods here
}
