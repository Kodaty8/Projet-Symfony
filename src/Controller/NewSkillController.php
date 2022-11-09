<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewSkillType;
use App\Entity\Skill;

class NewSkillController extends AbstractController
{
    #[Route('/new/skill', name: 'app_new_skill')]
    public function index(): Response
    {
        $skill = new Skill();
        $form = $this->createForm(NewSkillType::class, $skill);

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'skill',
            'form' => $form,
        ]);
    }
}
