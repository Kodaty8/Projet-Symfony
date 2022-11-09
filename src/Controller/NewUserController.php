<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewUserType;
use App\Entity\User;

class NewUserController extends AbstractController
{
    #[Route('/new/user', name: 'app_new_user')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'profile',
            'form' => $form,
        ]);
    }
}
