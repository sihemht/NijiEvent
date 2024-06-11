<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\{PasswordType};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ArrayField, TextField, EmailField, IdField};
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFilters(Filters $filters): Filters{

        return $filters
        ->add('id')
        ->add('username')
        ->add('email')
        ->add('roles')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            EmailField::new('email'),
            TextField::new('username'),
           // TextField::new('password')
               // ->setFormType(PasswordType::class),
                ArrayField::new('roles'),
        ];
    }

}
