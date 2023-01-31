<?php

namespace App\Controller\Admin;

use App\Entity\Talk;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TalkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Talk::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            TextEditorField::new('description'),
            ChoiceField::new('niveau')->setChoices(fn () => [
                'Débutant' => 'debutant', 
                'Intermédiaire' => 'intermediaire',
                'Avancé' => 'avancé'
            ]),
            UrlField::new('youtube_url'),
            ImageField::new('coverFilename')
                ->setUploadDir('public/uploads/images/')
                ->setBasePath('uploads/images/'),
            AssociationField::new('meetup'),
            AssociationField::new('speaker'),
            ArrayField::new('tags'),
        ];
    }
    
}
