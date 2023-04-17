<?php

namespace App\Controller\Admin;

use App\Entity\PortfolioTag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PortfolioTagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PortfolioTag::class;
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
