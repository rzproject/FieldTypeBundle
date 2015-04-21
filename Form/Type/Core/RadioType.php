<?php

/*
 * This file is part of the RzFieldTypeBundle package.
 *
 * (c) mell m. zamora <mell@rzproject.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rz\FieldTypeBundle\Form\Type\Core;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RadioType extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        $view->vars['icheck_endabled'] = array_key_exists('icheck_endabled', $options) ? $options['icheck_endabled'] : true;
        $view->vars['icheck_custom_label'] = true;

        //* TODO: enable via config
        if ($view->vars['icheck_endabled']) {
            $view->vars['attr']['class'] = array_key_exists('class', $view->vars['attr']) ? sprintf("icheck-me %s", $view->vars['attr']['class']) : "icheck-me";
            $view->vars['icheck_inline'] = array_key_exists('icheck_inline', $options) ? $options['icheck_inline'] : true;

            $view->vars['attr']['data-skin'] = array_key_exists('icheck_data_skin', $options) ? $options['icheck_data_skin'] : 'minimal';
            $view->vars['attr']['data-color'] = array_key_exists('icheck_color', $options) ? $options['icheck_color'] : 'aero';
        }
    }

    /**
     * {@inheritdoc}
     *
     * @todo Remove it when bumping requirements to SF 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $optionalOptions = array('icheck_endabled',
            'icheck_custom_label',
            'icheck_data_skin',
            'icheck_color',
            'icheck_inline',
            'uniform_endabled');

        if (method_exists($resolver, 'setDefined')) {
            $resolver->setDefined($optionalOptions);
        } else {
            // To keep Symfony <2.6 support
            $resolver->setOptional($optionalOptions);
        }

        $resolver->setDefaults(array('icheck_endabled'=> true,
            'icheck_custom_label'=> true,
            'icheck_data_skin' => 'minimal',
            'icheck_color' => 'aero',
            'icheck_inline'=>true));
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'radio';
    }
}
