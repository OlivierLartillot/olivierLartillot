<?php

namespace App\Controller\Admin;

use App\Entity\RealisationGallerie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class RealisationGallerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RealisationGallerie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $package = new Package(new EmptyVersionStrategy());

        // gestion local en env dev ou ligne prod

        if ($_ENV['APP_ENV']  == 'dev' ){
            $uploadPath = $package->getUrl('public\img\realisations\gallerie\\');  
        } else{
            $uploadPath = $package->getUrl('public/img/realisations/gallerie/');  
        }

        $path = $package->getUrl('/img/realisations/gallerie');


        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('image')->setUploadDir($uploadPath)->setBasePath($path),
            TextEditorField::new('description'),
            AssociationField::new('realisation')
        ];
    }
    
}
