<?php

namespace App\Controller;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompaniesController extends AbstractController
{
    #[Route('/companies', name: 'companies')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Company::class);
        $companies = $repository->findAll();

        return $this->render('companies/index.html.twig', [
            'companies' => $companies,
        ]);
    }
}
