<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewOfferType;
use App\Entity\Offer;

class NewOfferController extends AbstractController
{
    #[Route('/offer/new/{id}', name: 'app_new_offer', defaults: ['id'=>0])]
    public function newOffer(int $id, Request $request, OfferRepository $offerRepository): Response
    {
        $offer = new offer();
        if ($id > 0){
            $offer = $offerRepository->find($id);
        }
        $form = $this->createForm(NewOfferType::class, $offer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $offer = $form->getData();
            $offerRepository->save($offer, true);

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'offer',
            'form' => $form,
        ]);
    }
}
