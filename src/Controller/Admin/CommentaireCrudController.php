<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;


class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         IdField::new('id'),
    //         AssociationField::new('user')->setSortProperty('nom'),
    //         AssociationField::new('moto')->setSortProperty('nom'),
    //         // AssociationField::new('reservation')->setSortProperty('nom'),
    //         IntegerField::new('notemoto'),
    //         TextField::new('textemoto'),
    //         IntegerField::new('noteproprio'),
    //         TextField::new('texteproprio')
    //     ];
    // }
    
}
