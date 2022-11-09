<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResourcesController extends AbstractController
{
    #[Route('/success', name: 'task_success')]
    public function index(): Response
    {
        return $this->render('resources/index.html.twig');
    }
}
