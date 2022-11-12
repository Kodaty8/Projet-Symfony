<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OfferRepository;
use App\Service\Matching;
use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    #[Route('/', name: 'offers')]
    public function index(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $repository = $em->getRepository(Offer::class);
        $offers = $repository->findAll();

        $offers = $paginator->paginate(
            $offers,
            $request->query->getInt('page', 1),
            6
        );

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

    #[Route('/offer/{id}', name: 'offer_show')]
    public function show(EntityManagerInterface $em, $id): Response
    {
        $repository = $em->getRepository(Offer::class);
        $offer = $repository->find($id);

        return $this->render('offers/show.html.twig', [
            'offer' => $offer,
        ]);
    }
}
