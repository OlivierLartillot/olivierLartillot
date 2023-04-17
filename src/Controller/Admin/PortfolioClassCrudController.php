<?php

namespace App\Controller\Admin;

use App\Entity\PortfolioClass;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PortfolioClassCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PortfolioClass::class;
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
