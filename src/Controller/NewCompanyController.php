<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewCompanyType;
use App\Entity\Company;

class NewCompanyController extends AbstractController
{
    #[Route('/new/company', name: 'app_new_company')]
    public function newCompany(Request $request, ManagerRegistry $doctrine): Response
    {
        $company = new Company();
        $form = $this->createForm(NewCompanyType::class, $company);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $retrieved_data = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($retrieved_data);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'company',
            'form' => $form,
        ]);
    }
}
