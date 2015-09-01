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

class TimeType extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ($options['widget'] == 'single_text') {
            $view->vars['picker_enable'] = array_key_exists('picker_enable', $options) ? $options['picker_enable'] : true;

            if ($view->vars['picker_enable']) {
                $view->vars['attr']['readonly'] = 'readonly';
                $view->vars['picker_use_js_init'] = (array_key_exists('picker_use_js_init', $options)) ? $options['picker_use_js_init'] : false;

                $class = "span5";
                if (array_key_exists('picker_attr', $options)) {
                    if (array_key_exists('class',$options['picker_attr'])) {
                        $class = $options['picker_attr']['class'];
                    }
                }

                if ($view->vars['picker_use_js_init']) {
                    $view->vars['attr']['class'] = (array_key_exists('class', $view->vars['attr'])) ? sprintf("rz-custom-timepicker %s", $view->vars['attr']['class']) : 'rz-custom-timepicker';
                    $view->vars['picker_options'] = array_key_exists('picker_options', $options) ? array_merge($options['picker_options'], array('autoclose'=>true, 'format'=>$view->vars['attr']['data-date-format'])) : array('weekStart'=>0, 'viewMode'=>0, 'minViewMode'=>0, 'autoclose'=>true);
                } else {
                    $view->vars['attr']['class'] = (array_key_exists('class', $view->vars['attr'])) ? sprintf("rz-timepicker %s", $view->vars['attr']['class']) : 'rz-timepicker';
                }

                $view->vars['picker_container_class'] = $class;
            }
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
        $optionalOptions = array('picker_enable', 'picker_options', 'picker_use_js_init');

        if (method_exists($resolver, 'setDefined')) {
            $resolver->setDefined($optionalOptions);
        } else {
            // To keep Symfony <2.6 support
            $resolver->setOptional($optionalOptions);
        }

        $resolver->setDefaults(array(
            'widget'         => 'single_text',
            'with_minutes'   => true,
            'with_seconds'   => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'time';
    }
}
