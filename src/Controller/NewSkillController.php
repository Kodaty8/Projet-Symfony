<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewSkillType;
use App\Entity\Skill;

class NewSkillController extends AbstractController
{
    #[Route('/new/skill', name: 'app_new_skill')]
    public function newSkill(Request $request, ManagerRegistry $doctrine): Response
    {
        $skill = new Skill();
        $form = $this->createForm(NewSkillType::class, $skill);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $retrieved_data = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($retrieved_data);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }
        
        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'skill',
            'form' => $form,
        ]);
    }
}
