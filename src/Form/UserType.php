<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('datenaissance', BirthdayType::class, [
                'placeholder' => 'Select a value',
                ])
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('telephone')
            ->add('imageFile', VichImageType::class,[
                'required'=>false,  
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
