<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewUserType;
use App\Entity\User;

class NewUserController extends AbstractController
{
    #[Route('/new/user', name: 'app_new_user')]
    public function newUser(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $retrieved_data = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($retrieved_data);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'profile',
            'form' => $form,
        ]);
    }
}
