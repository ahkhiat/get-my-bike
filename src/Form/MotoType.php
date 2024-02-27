<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\Moto;
use App\Entity\Proprietaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annee')
            ->add('couleur')
            ->add('prixJour')
            ->add('dispo')
            ->add('nombreNotes')
            ->add('moyenneNotes')
            ->add('modele', EntityType::class, [
                'class' => Modele::class,
'choice_label' => 'id',
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => Proprietaire::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Moto::class,
        ]);
    }
}
