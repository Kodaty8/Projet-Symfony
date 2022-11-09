<?php

namespace App\Form;

use App\Entity\Offer;
use App\Entity\Company;
use App\Entity\Skill;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('requirements', EntityType::class, [
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
            'data_class' => Offer::class,
        ]);
    }
}
