<?php

namespace App\Controller\Admin;

use App\Entity\Realisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class RealisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Realisation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $package = new Package(new EmptyVersionStrategy());

        // gestion local en env dev ou ligne prod

        if ($_ENV['APP_ENV']  == 'dev' ){
            $uploadPathThumbnail = $package->getUrl('public\img\realisations\thumbnails\\');  
        } else{
            $uploadPathThumbnail = $package->getUrl('public/img/realisations/thumbnails/');  
        }

        $pathThumbnail = $package->getUrl('/img/realisations/thumbnails');

        if ($_ENV['APP_ENV']  == 'dev' ){
            $uploadPathFullImage = $package->getUrl('public\img\realisations\full\\');  
        } else{
            $uploadPathFullImage = $package->getUrl('public/img/realisations/full/');  
        }

        $pathFullImage = $package->getUrl('/img/realisations/full');

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('subtitle'),
            TextField::new('date'),
            ImageField::new('thumbnail')->setUploadDir($uploadPathThumbnail)->setBasePath($pathThumbnail)->setHelp('<ul><li>Une image carrée rendra mieux qu\'une image trop large ou trop haute ! </li><li>supprimer l\'image la supprimera définitivement</li></ul>'),
            ImageField::new('fullImage')->setUploadDir($uploadPathFullImage)->setBasePath($pathFullImage)->setHelp('<ul><li>Une image carrée rendra mieux qu\'une image trop large ou trop haute ! </li><li>supprimer l\'image la supprimera définitivement</li></ul>'),
            TextEditorField::new('content'),
            TextEditorField::new('technicalContent'),
            TextField::new('siteLink'),
            BooleanField::new('online'),
            TextField::new('typeOfWork'),
            TextField::new('Country'),
            AssociationField::new('stack'),
            AssociationField::new('imagesSlider'),
            

        ];
    }
   
}
