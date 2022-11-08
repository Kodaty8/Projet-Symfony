<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompaniesController extends AbstractController
{
    #[Route('/companies', name: 'app_companies')]
    public function index(CompanyRepository $companyRepository): Response
    {
        $companies = $companyRepository->findAll();
        db($companies);

        return $this->render('companies/index.html.twig', [
            'controller_name' => 'CompaniesController',
            'title' => 'Companies',
        ]);
    }
}
