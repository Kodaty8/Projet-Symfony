<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewUserType;
use App\Entity\User;

class NewUserController extends AbstractController
{
    #[Route('/user/new', name: 'app_new_user')]
    public function newUser(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepository->save($user, true);

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'profile',
            'form' => $form,
        ]);
    }
}
