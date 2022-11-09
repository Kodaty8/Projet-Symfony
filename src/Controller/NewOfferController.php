<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewOfferType;
use App\Entity\Offer;

class NewOfferController extends AbstractController
{
    #[Route('/new/offer', name: 'app_new_offer')]
    public function newOffer(Request $request, ManagerRegistry $doctrine): Response
    {
        $offer = new offer();
        $form = $this->createForm(NewOfferType::class, $offer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $retrieved_data = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($retrieved_data);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'offer',
            'form' => $form,
        ]);
    }
}
