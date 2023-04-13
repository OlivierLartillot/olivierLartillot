<?php

namespace App\Controller\Admin;

use App\Entity\Realisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RealisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Realisation::class;
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
