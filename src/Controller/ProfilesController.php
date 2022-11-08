<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilesController extends AbstractController
{
    #[Route('/profiles', name: 'app_profiles')]
    public function index(): Response
    {
        
        return $this->render('profiles/index.html.twig', [
            'controller_name' => 'ProfilesController',
            'title' => 'Profiles',
        ]);
    }
}