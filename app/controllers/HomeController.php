<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Province;
use App\Models\Office;
use App\Models\Company;
use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public function index()
    {
        $provinceModel = new Province();
        $officeModel = new Office();

        $postModel = new Post();
        $posts = $postModel->getAllPosts(5, 1);
        $guides = $postModel->getPostsByPostType(1, 1, 15);
        $notices = $postModel->getPostsByPostType(2, 1, 4);
        $faqs = $postModel->getPostsByPostType(3, 1, 10);        

        $companyModel = new Company();
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
            'description' => 'این صفحه اصلی وبلاگ است که آخرین پست ها و اخبار را نمایش می دهد.',
            'keywords' => 'صفحه اصلی, وبلاگ, اخبار, پست ها',
        ];

        view::render('public/home/index', $viewData, 'public');
    }
}
