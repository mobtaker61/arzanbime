<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Quotation;
use App\Models\Tariff;
use Core\View;

class OffersController extends Controller
{
    public function show($uid)
    {
        $quotationModel = new Quotation();
        $tariffModel = new Tariff();

        // Fetch the quotation data using the UID
        $quotation = $quotationModel->getQuotation($uid);

        if (!$quotation) {
            http_response_code(404);
            View::render('public/404', [], 'public');
            return;
        }

        // Fetch tariffs based on the quotation data
        $tariffs = $tariffModel->getTariffsByAge($quotation['age']);
        $userLevelId = $quotation['user_level_id']; // فرض می‌کنیم که سطح کاربر در داده‌های استعلام موجود است

        // Calculate discounts and payable amounts
        foreach ($tariffs as &$tariff) {
            $discountRate = $tariffModel->getPackageDiscount($tariff['package_id'], $userLevelId);
            if ($discountRate === null) {
                $discountRate = 0;
            }
            $commissionRate = $discountRate / 100;
            $tariff['discount_rate'] = intval($discountRate);
            $tariff['first_year_discount'] = intval($tariff['first_year'] * $commissionRate);
            $tariff['two_year_discount'] = intval($tariff['two_year'] * $commissionRate);
            $tariff['first_year_pay'] = intval($tariff['first_year'] - $tariff['first_year_discount']);
            $tariff['two_year_pay'] = intval($tariff['two_year'] - $tariff['two_year_discount']);
        }

        // Prepare data for the view
        $viewData = [
            'quotation' => $quotation,
            'tariffs' => $tariffs,
            'pagetitle' => 'پیشنهادات',
            'description' => 'صفحه پیشنهادات بر اساس اطلاعات وارد شده در فرم.',
            'keywords' => 'پیشنهادات, بیمه, تعرفه',
        ];

        // Render the view
        View::render('public/offers/index', $viewData, 'public');
    }
}
