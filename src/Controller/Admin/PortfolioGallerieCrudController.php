<?php

// !!! ATTENTION CELA CORRESPOND AU REALISATIONS !!!

namespace App\Controller\Admin;

use App\Entity\PortfolioGallerie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class PortfolioGallerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PortfolioGallerie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $package = new Package(new EmptyVersionStrategy());

        // gestion local en env dev ou ligne prod
        //* Gestion des photos et videos */
        if ($_ENV['APP_ENV']  == 'dev' ){
            $uploadPathFullImage = $package->getUrl('public\img\realisations\full\\');  
        } else{
            $uploadPathFullImage = $package->getUrl('public/img/realisations/full/');  
        }

        $pathFullImage = $package->getUrl('/img/realisations/full');

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            ImageField::new('image')->setUploadDir($uploadPathFullImage)->setBasePath($pathFullImage)
                                          ->setRequired($pageName !== Crud::PAGE_EDIT) 
                                          ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : []), 
        ];
    }
   
}
