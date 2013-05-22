<?php

namespace Rz\FieldTypeBundle\Form\Type\Core;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RadioType extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['uniform_endabled'] = array_key_exists('uniform_endabled', $options) ? $options['uniform_endabled'] : true;

        //* TODO: enable via config
        if($view->vars['uniform_endabled']) {
            $view->vars['attr']['class'] = array_key_exists('class', $view->vars['attr']) ? sprintf("uni_style_radio %s", $view->vars['attr']['class']) : "uni_style_radio";
        }
    }


    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('uniform_endabled')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'radio';
    }
}
