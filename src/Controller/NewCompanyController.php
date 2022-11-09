<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewCompanyType;
use App\Entity\Company;

class NewCompanyController extends AbstractController
{
    #[Route('/company/new', name: 'app_new_company')]
    public function newCompany(Request $request, CompanyRepository $companyRepository): Response
    {
        $company = new Company();
        $form = $this->createForm(NewCompanyType::class, $company);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $company = $form->getData();
            $companyRepository->save($company, true);

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'company',
            'form' => $form,
        ]);
    }
}
