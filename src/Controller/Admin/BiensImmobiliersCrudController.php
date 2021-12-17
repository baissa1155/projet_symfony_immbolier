<?php

namespace App\Controller\Admin;

use App\Entity\BiensImmobiliers;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BiensImmobiliersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BiensImmobiliers::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-user')->addCssClass('btn btn-succes');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye')->addCssClass('btn btn-info');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-eye')->addCssClass('btn btn-outline-danger');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', label: 'ID')->onlyOnIndex(),
            DateTimeField::new('date_soumis')
                ->hideOnForm()
                ->onlyOnDetail(),

            TextField::new('localite'),
            AssociationField::new('quartier'),
            AssociationField::new('chambres'),
            AssociationField::new('typesLogements'),
            TextEditorField::new('description'),
            TextField::new('rue_et_numero'),
            NumberField::new('revenue_cadestral'),
            NumberField::new('prix'),
            NumberField::new('pieces'),
            TextField::new('surface'),
            textField::new('parking'),

            BooleanField::new('meuble'),
            BooleanField::new('jardin'),
            BooleanField::new('a_louer'),
            BooleanField::new('a_vendre'),

            ImageField::new('photo_du_bien')
                ->setBasePath(path: 'img/biens/')
                ->setUploadDir(uploadDirPath: 'public/img/biens')
            // ->setUploadedFileNamePattern(patternOrCallable: '[ramdomHash].[extension]')
        ];
    }
}
