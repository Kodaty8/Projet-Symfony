<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewOfferType;
use App\Entity\Offer;

class NewOfferController extends AbstractController
{
    #[Route('/new/offer', name: 'app_new_offer')]
    public function index(): Response
    {
        $offer = new offer();
        $form = $this->createForm(NewOfferType::class, $offer);

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'offer',
            'form' => $form,
        ]);
    }
}
