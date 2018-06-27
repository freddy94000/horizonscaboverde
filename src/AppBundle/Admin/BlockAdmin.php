<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class BlockAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('export')
            ->remove('show')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title', null, ['label' => 'Titre'])
            ->add('rank', null, ['label' => 'Rang'])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        $imageOptions = ['label' => 'Image', 'required' => false];

        if ($subject->getImageName()) {
            $imageOptions['help'] = '<img src="/images/' . $subject->getImageName() . '" style="max-height: 200px; max-width: 200px;" />';
        }

        $formMapper
            ->add('title', null, ['label' => 'Titre'])
            ->add('content', CKEditorType::class, ['label' => 'Contenu'])
            ->add('rank', null, ['label' => 'Rang'])
            ->add('imageFile', 'Vich\UploaderBundle\Form\Type\VichFileType', $imageOptions)
        ;
    }
}
