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

class DateType extends AbstractTypeExtension
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ($options['widget'] == 'single_text') {
            $view->vars['picker_enable'] = array_key_exists('picker_enable', $options) ? $options['picker_enable'] : true;

            if ($view->vars['picker_enable']) {
                $view->vars['attr']['readonly'] = 'readonly';
                $view->vars['picker_use_js_init'] = (array_key_exists('picker_use_js_init', $options)) ? $options['picker_use_js_init'] : false;

                if ($view->vars['picker_use_js_init']) {
                    $view->vars['picker_class_attr'] =  $this->mergePickerAttr($options, true);
                    $view->vars['picker_options'] = array_key_exists('picker_options', $options) ? array_merge($options['picker_options'], array('weekStart'=>0, 'viewMode'=>0, 'minViewMode'=>0, 'autoclose'=>true)) : array('weekStart'=>0, 'viewMode'=>0, 'minViewMode'=>0, 'autoclose'=>true);
                } else {
                    $view->vars['picker_class_attr'] = $this->mergePickerAttr($options);
                }

                $view->vars['picker_settings'] =  $options['picker_settings'];

                $view->vars['picker_container_class'] =  $options['picker_container_class'];
            }

        }
    }

    protected function mergePickerAttr($pickerAttr, $isCustom = false)
    {
        if (array_key_exists('picker_class_attr', $pickerAttr)) {
           $class = implode(array_merge(array('input-append', 'date'), $pickerAttr['picker_class_attr']),' ');
        } else {
            $class = 'input-append date';
        }

        return array('class'=>$class.sprintf(" %s", $isCustom ? 'rz-custom-datepicker' : 'rz-datepicker'));
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
        /**
         * TODO: resolve date format difference
         */
        $optionalOptions = array('picker_settings', 'picker_enable', 'picker_options', 'picker_use_js_init', 'picker_class_attr', 'picker_container_class');

        if (method_exists($resolver, 'setDefined')) {
            $resolver->setDefined($optionalOptions);
        } else {
            // To keep Symfony <2.6 support
            $resolver->setOptional($optionalOptions);
        }

        $resolver->setDefaults(array(
            'widget'         => 'single_text',
            'format'         => 'dd-MM-yyyy',
            'input'          => 'datetime',
            'picker_settings'    => array('data-date-format'=>'dd-mm-yyyy'),
            'picker_container_class' => 'span5',
            'error_bubbling'     => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'date';
    }
}
