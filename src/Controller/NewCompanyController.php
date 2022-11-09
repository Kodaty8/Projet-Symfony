<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewCompanyType;
use App\Entity\Company;

class NewCompanyController extends AbstractController
{
    #[Route('/new/company', name: 'app_new_company')]
    public function index(): Response
    {
        $company = new Company();
        $form = $this->createForm(NewCompanyType::class, $company);

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'company',
            'form' => $form,
        ]);
    }
}
