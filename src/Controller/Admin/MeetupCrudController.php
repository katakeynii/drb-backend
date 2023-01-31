<?php

namespace App\Controller\Admin;

use App\Entity\Meetup;
use phpDocumentor\Reflection\Types\Boolean;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MeetupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Meetup::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            TextEditorField::new('description'),
            DateTimeField::new('meetupDate'),
            TextField::new('lieu'),
            UrlField::new('zoom_link'),
            UrlField::new('youtube_link'),
            ImageField::new('coverFilename')
                ->setUploadDir('public/uploads/images/')
                ->setBasePath('uploads/images/'),
            BooleanField::new('published')
        ];
    }
    
}
