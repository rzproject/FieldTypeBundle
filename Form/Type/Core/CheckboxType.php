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
            $view->vars['uniform_endabled'] = array_key_exists('uniform_endabled', $options) ? $options['uniform_endabled'] : true;
            $view->vars['uniform_custom_label'] = true;
            $view->vars['switch_enabled'] =  false;
            $view->vars['switch_attr'] =  null;
            //* TODO: enable via config
            if ($view->vars['uniform_endabled']) {
                $view->vars['attr']['class'] = array_key_exists('class', $view->vars['attr']) ? sprintf("uni_style_checkbox %s", $view->vars['attr']['class']) : "uni_style_checkbox";
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('uniform_endabled',
                                     'uniform_custom_label',
                                     'switch_enabled',
                                     'switch_attr',
                                    )
                              );

        $resolver->setDefaults(array('uniform_endabled' => true,
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
