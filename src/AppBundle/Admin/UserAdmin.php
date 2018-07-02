<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;

class UserAdmin extends SonataUserAdmin
{

    protected function configureFormFields(FormMapper $formMapper) : void
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->add('hcode', null, ['label' => 'Hcode'])
            ->add('address', null, ['label' => 'Adresse'])
            ->add('codePostal', null, ['label' => 'Code Postal'])
            ->add('city', null, ['label' => 'Ville'])
            ->add('company', null, ['label' => 'Entreprise'])
            ->add('activity', null, ['label' => 'Activité'])
            ->add('proffession', null, ['label' => 'Proffession'])
        ;
    }
}
