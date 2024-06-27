<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Province;
use App\Models\Office;
use App\Models\Company;
use App\Models\Tariff;
use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public function index()
    {
        $postModel = new Post();
        $officeModel = new Office();
        $companyModel = new Company();
        $provinceModel = new Province();

        $posts = $postModel->getAllPosts(5, 1);
        $guides = $postModel->getPostsByPostType(1, 1, 15);
        $notices = $postModel->getPostsByPostType(2, 1, 4);
        $faqs = $postModel->getPostsByPostType(3, 1, 5);

        $companies = $companyModel->getAllCompanies();

        $provinces = $provinceModel->getAllProvinces();
        $offices = $officeModel->getOfficesByProvinceId($provinces[0]['id']); // Initially fetch offices for the first province        

        $viewData = [
            'posts' => $posts,
            'guides' => $guides,
            'notices' => $notices,
            'faqs' => $faqs,
            'provinces' => $provinces,
            'offices' => $offices,
            'companies' => $companies,
            'pagetitle' => 'خانه',
            'description' => 'ما بیمه سلامت و اجازه اقامت را به‌صورت آنلاین و سریع در سه مرحله ساده ارائه می‌دهیم.',
            'keywords' => 'بیمه, اقامت,سلامت,ترکیه,راندوو,بیمه اقامت, اقامت ترکیه,saglik,sigorta',
        ];

        view::render('public/home/index', $viewData, 'public');
    }

    public function getTariffSummary($companyId)
    {
        $tariffModel = new Tariff();
        $tariffs = $tariffModel->getTariffsByCompanyId($companyId);

        $summary = [];
        $currentRange = null;
        $lastFirstYear = null;
        $lastSecondYear = null;
        $lastTwoYear = null;
        $currentTip = null;
        $connector = ' تا ';

        foreach ($tariffs as $tariff) {
            $tip = $tariff['package_tip'];
            if (!isset($summary[$tip])) {
                $summary[$tip] = [
                    'color' => $tariff['package_color'], // Include the color for each tip
                    'tariffs' => []
                ];
            }
            if (
                $tariff['first_year'] === $lastFirstYear &&
                $tariff['second_year'] === $lastSecondYear &&
                $tariff['two_year'] === $lastTwoYear &&
                $tip === $currentTip
            ) {
                $currentRange['end'] = $tariff['age'];
            } else {
                if ($currentRange) {
                    $summary[$currentTip]['tariffs'][] = [
                        'age_range' => $currentRange['start'] . (isset($currentRange['end']) ? $connector . $currentRange['end'] : ''),
                        'first_year' => number_format((int)$lastFirstYear),
                        'second_year' => number_format((int)$lastSecondYear),
                        'two_year' => number_format((int)$lastTwoYear)
                    ];
                }
                $currentRange = [
                    'start' => $tariff['age']
                ];
                $lastFirstYear = $tariff['first_year'];
                $lastSecondYear = $tariff['second_year'];
                $lastTwoYear = $tariff['two_year'];
                $currentTip = $tip;
            }
        }

        if ($currentRange) {
            $summary[$currentTip]['tariffs'][] = [
                'age_range' => $currentRange['start'] . (isset($currentRange['end']) ? $connector . $currentRange['end'] : ''),
                'first_year' => number_format((int)$lastFirstYear),
                'second_year' => number_format((int)$lastSecondYear),
                'two_year' => number_format((int)$lastTwoYear)
            ];
        }

        echo json_encode($summary);
    }
}
