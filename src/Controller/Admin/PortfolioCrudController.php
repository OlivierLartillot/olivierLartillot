<?php

namespace App\Controller\Admin;

use App\Entity\Portfolio;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class PortfolioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Portfolio::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $package = new Package(new EmptyVersionStrategy());

        // gestion local en env dev ou ligne prod
        //* Gestion des photos et videos */
        if ($_ENV['APP_ENV']  == 'dev' ){
            $uploadPath = $package->getUrl('public\img\portfolio\\');  
        } else{
            $uploadPath = $package->getUrl('public/img/portfolio/');  
        }
        $path = $package->getUrl('/img/portfolio/');

        //* Gestion des videos */
        if ($_ENV['APP_ENV']  == 'dev' ){
            $uploadVideosPath = $package->getUrl('public\videos\portfolio\\');  
        } else{
            $uploadVideosPath = $package->getUrl('public/videos/portfolio/');  
        }
        $videoPath = $package->getUrl('/videos/portfolio/');



        return [
            yield IdField::new('id')->hideOnForm(),
            yield TextField::new('title'),
            // IMAGE REQUIRED: quand on enregistre une image requise dans EDITION il y a un probleme car il attend une nouvelle image
            // DONC on dit que ce n est pas requis dans edit
            // ET on ne peut pas supprimer l'image, juste la remplacer !!!
            yield ImageField::new('image')->setUploadDir($uploadPath)->setBasePath($path)
                                          ->setRequired($pageName !== Crud::PAGE_EDIT) 
                                          ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : []), 
            yield AssociationField::new('portfolioClass', 'class')->setHelp('Affiche l\'image de photo ou vidéo'),
            yield ImageField::new('url', 'Vidéo')->setUploadDir($uploadVideosPath)->setBasePath($videoPath)->setHelp('A laisser null si c\'est une photo'),
                                          
            yield AssociationField::new('portfolioTags', 'Tags')->setHelp('Les tags de filtre à ajouter à l\'image'),
        ];
    }
   
}
