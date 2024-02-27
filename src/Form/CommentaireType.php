<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Moto;
use App\Entity\Proprietaire;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('noteMoto')
            ->add('texteMoto')
            ->add('noteProprio')
            ->add('texteProprio')
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('moto', EntityType::class, [
                'class' => Moto::class,
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
            'data_class' => Commentaire::class,
        ]);
    }
}
