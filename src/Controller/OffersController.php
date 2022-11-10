<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OfferRepository;
use App\Service\Matching;
use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    #[Route('/', name: 'offers')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Offer::class);
        $offers = $repository->findAll();

        return $this->render('offers/index.html.twig', [
            'offers' => $offers,
        ]);
    }
    #[Route('/offers/matching/{id}', name: 'matches')]
    public function matches(User $user, OfferRepository $offers, Matching $matching): Response
    {
        $matches = $matching->getMatchingOffers($user, $offers);

        return $this->render('offers/index.html.twig', [
            'offers' => $matches,
        ]);
    }
}
