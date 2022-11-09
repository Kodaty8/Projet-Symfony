<?php

namespace App\Controller;

use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    #[Route('/offers', name: 'offers')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Offer::class);
        $offers = $repository->findAll();
        dd($offers);

        return $this->render('offers/index.html.twig');
    }
}
