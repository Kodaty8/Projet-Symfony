<?php

namespace App\Controller;

use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\NewSkillType;
use App\Entity\Skill;

class NewSkillController extends AbstractController
{
    #[Route('/skills/new/{id}', name: 'new_skill', defaults: ['id'=>0])]
    public function newSkill(int $id, Request $request, SkillRepository $skillRepository): Response
    {
        $skill = new Skill();
        if ($id > 0){
            $skill = $skillRepository->find($id);
        }
        $form = $this->createForm(NewSkillType::class, $skill);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $skill = $form->getData();
            $skillRepository->save($skill, true);

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('new_resource/index.html.twig', [
            'title' => 'skill',
            'form' => $form,
        ]);
    }
}
