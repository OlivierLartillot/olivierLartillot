<?php

namespace App\Controller\Admin;

use App\Entity\ImageRealisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class ImageRealisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageRealisation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $package = new Package(new EmptyVersionStrategy());
        
        if ($_ENV['APP_ENV']  == 'dev' ){
            $uploadPathFullImage = $package->getUrl('public\img\realisations\full\\');  
        } else{
            $uploadPathFullImage = $package->getUrl('public/img/realisations/full/');  
        }

        $pathFullImage = $package->getUrl('/img/realisations/full');

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            ImageField::new('image')->setUploadDir($uploadPathFullImage)->setBasePath($pathFullImage)->setHelp('<ul><li>Une image carrée rendra mieux qu\'une image trop large ou trop haute ! </li><li>supprimer l\'image la supprimera définitivement</li></ul>'),
            AssociationField::new('realisation')
        ];
    }
   
}
