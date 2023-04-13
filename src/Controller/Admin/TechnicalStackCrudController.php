<?php

namespace App\Controller\Admin;

use App\Entity\TechnicalStack;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TechnicalStackCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TechnicalStack::class;
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
