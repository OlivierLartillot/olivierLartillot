<?php

namespace App\Controller\Admin;

use App\Entity\Reseau;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReseauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reseau::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
