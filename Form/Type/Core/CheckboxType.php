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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheckboxType extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        if ($options['switch_enabled']) {
            $view->vars['switch_enabled'] =  $options['switch_enabled'];
            $view->vars['switch_attr'] =  $options['switch_attr'];
            $view->vars['uniform_endabled'] = false;
            $view->vars['uniform_custom_label'] = false;

        } else {
            $view->vars['icheck_endabled'] = array_key_exists('icheck_endabled', $options) ? $options['icheck_endabled'] : true;
            $view->vars['icheck_custom_label'] = true;
            $view->vars['switch_enabled'] =  false;
            $view->vars['switch_attr'] =  null;
            //* TODO: enable via config
            if ($view->vars['icheck_endabled']) {
                $view->vars['attr']['class'] = array_key_exists('class', $view->vars['attr']) ? sprintf("icheck-me %s", $view->vars['attr']['class']) : "icheck-me";
                $view->vars['icheck_inline'] = array_key_exists('icheck_inline', $options) ? $options['icheck_inline'] : true;

                $view->vars['attr']['data-skin'] = array_key_exists('icheck_data_skin', $options) ? $options['icheck_data_skin'] : 'minimal';
                $view->vars['attr']['data-color'] = array_key_exists('icheck_color', $options) ? $options['icheck_color'] : 'aero';
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('icheck_endabled',
                                     'icheck_custom_label',
                                     'icheck_data_skin',
                                     'icheck_color',
                                     'icheck_inline',
                                     'uniform_endabled',
                                     'uniform_custom_label',
                                     'switch_enabled',
                                     'switch_attr',
                                    )
                              );

        $resolver->setDefaults(array('icheck_endabled'=> true,
                                     'icheck_custom_label'=> true,
                                     'icheck_data_skin' => 'minimal',
                                     'icheck_color' => 'aero',
                                     'icheck_inline'=>true,
                                     'uniform_endabled' => true,
                                     'uniform_custom_label' => true,
                                     'switch_enabled' => false,
                                     'switch_attr' => array('data-on-label'=>'ON', 'data-off-label'=>'OFF'),
                                     'error_bubbling'=> true
                               )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'checkbox';
    }
}
