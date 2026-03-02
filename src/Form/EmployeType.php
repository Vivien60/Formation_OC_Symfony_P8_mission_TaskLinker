<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Projet;
use App\Enum\EmployeRole;
use App\Enum\EmployeTypeContrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
            ])
            ->add('adresseEmail', EmailType::class, [
                'required' => true,
            ])
            ->add('dateEntree', DateType::class, [
                'required' => true,
            ])
            ->add('typeContrat', EnumType::class, [
                'required' => true,
                'class' => EmployeTypeContrat::class,
                'choice_label' => 'getLabel',
            ])
            ->add('role', EnumType::class, [
                'required' => true,
                'class' => EmployeRole::class,
                'choice_label' => 'getLabel',
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
