<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;

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
            ->add('code', null, ['label' => 'Code'])
            ->add('title', null, ['label' => 'Titre'])
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
            ->add('code', null, ['label' => 'Code'])
            ->add('title', null, ['label' => 'Titre'])
            ->add('content', 'textarea', [
                'label' => 'Contenu',
                'attr' => [
                    'rows' => '10'
                ],
            ])
            ->add('imageFile', 'Vich\UploaderBundle\Form\Type\VichFileType', $imageOptions)
        ;
    }
}
