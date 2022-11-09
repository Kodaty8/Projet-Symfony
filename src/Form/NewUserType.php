<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('mail')
            ->add('photo', TextType::class, ['label' => 'Profile picture URL'])
            ->add('description')
            ->add('skills', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
