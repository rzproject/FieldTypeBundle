<?php

namespace Rz\FieldTypeBundle\Form\Type\Core;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['thumbnail_enabled'] = $options['thumbnail_enabled'] ? $options['thumbnail_enabled'] : false;
        $view->vars['current_subject'] = $options['current_subject'] ? $options['current_subject'] : null;

        $view->vars = array_replace($view->vars, array(
            'type'  => 'file',
            'value' => '',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setOptional(array('thumbnail_enabled'));

        $resolver->setDefaults(array(
            'compound' => false,
            'data_class' => 'Symfony\Component\HttpFoundation\File\File',
            'empty_data' => null,
            'thumbnail_enabled' => false,
            'current_subject' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'file';
    }
}
