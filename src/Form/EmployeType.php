<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', [
                'attr' => ['class' => 'btn btn-success']
            ])
            
            ->add('prenom', [
                'attr' => ['class' => 'btn btn-success']
            ])

            ->add('dateNaissance', [
                'widget' =>'single_text',
                'attr' => ['class' => 'form-control']
            ])

            ->add('dateEmbauche', [
                'widget' =>'single_text',
                'attr' => ['class' => 'form-control']
            ])

            ->add('ville', [
                'attr' => ['class' => 'btn btn-success']
            ])

            ->add('entreprise', [
                'attr' => ['class' => 'btn btn-success']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
