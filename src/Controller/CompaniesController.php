<?php

namespace App\Controller;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompaniesController extends AbstractController
{
    #[Route('/companies', name: 'companies')]
    public function index(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $repository = $em->getRepository(Company::class);
        $companies = $repository->findAll();

        $companies = $paginator->paginate(
            $companies,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('companies/index.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/company/{id}', name: 'company_show')]
    public function show(EntityManagerInterface $em, $id): Response
    {
        $repository = $em->getRepository(Company::class);
        $company = $repository->find($id);

        return $this->render('companies/show.html.twig', [
            'companies' => $company,
        ]);
    }
}
