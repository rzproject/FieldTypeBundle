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

class ChoiceType extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        //parent::buildView($view, $form, $options);
        //* TODO: enable via config
        if ($options['expanded']) {
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled']= false;
            $view->vars['select2'] = $options['select2'] =  false;
            $view->vars['multiselect_enabled'] = $options['multiselect_enabled'] = false;
            $view->vars['multiselect_search_enabled'] = $options['multiselect_search_enabled'] = false;
        } elseif ($options['select2']) {
                $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled']= false;
                $view->vars['select2'] = $options['select2'] =  true;
                $view->vars['multiselect_enabled'] = $options['multiselect_enabled'] = false;
                $view->vars['multiselect_search_enabled'] = $options['multiselect_search_enabled'] = false;

                $view->vars['attr']['data-class-width'] = isset($view->vars['attr']['class']) ?$view->vars['attr']['class']: null;
                $view->vars['attr']['class'] = isset($view->vars['attr']['class']) ? sprintf("chosen-select %s", $view->vars['attr']['class']): 'chosen-select';
                $view->vars['attr']['chosen_data_placeholder'] = array_key_exists('chosen_data_placeholder', $options) ? $options['chosen_data_placeholder'] : 'Choose one of the following...';
                $view->vars['attr']['chosen_no_results_text'] = array_key_exists('chosen_no_results_text', $options) ? $options['chosen_no_results_text'] : 'No record found.';

        } elseif ($options['selectpicker_enabled']) {
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = true;
            $view->vars['select2'] = $options['select2'] = false;
            $view->vars['multiselect_enabled'] = $options['multiselect_enabled'] = false;
            $view->vars['multiselect_search_enabled'] = $options['multiselect_search_enabled'] = false;

            if (array_key_exists('class', $view->vars['attr'])) {
                $view->vars['attr']['class'] = sprintf("selectpicker %s", $view->vars['attr']['class']);
            } else {
                $view->vars['attr']['class'] = "selectpicker";
            }

            if (array_key_exists('selectpicker_show_tick', $options)) {
                $view->vars['attr']['class'] = sprintf("%s show-tick", $view->vars['attr']['class']);
            }

            if (array_key_exists('selectpicker_data_style', $options)) {
                $view->vars['attr']['data-style'] = $options['selectpicker_data_style'];
            }

            //* TODO: add translation
            if (array_key_exists('multiple', $options) && $options['multiple']) {
                $view->vars['attr']['title'] = array_key_exists('selectpicker_title', $options) ? $options['selectpicker_title'] : 'Choose one or more from selection...';
            } else {
                $view->vars['attr']['title'] = array_key_exists('selectpicker_title', $options) ? $options['selectpicker_title'] : 'Choose one of the following...';
            }

            $view->vars['attr']['data-size'] = array_key_exists('selectpicker_data_size', $options) ? $options['selectpicker_data_size'] : '10';

            if (array_key_exists('selectpicker_data_width', $options)) {
                $view->vars['attr']['data-width'] = $options['selectpicker_data_width'];
            }

            if (array_key_exists('selectpicker_disabled', $options)) {
                $view->vars['attr']['disabled'] = $options['selectpicker_disabled'];
            }

            if (array_key_exists('selectpicker_dropup', $options)) {
                $view->vars['attr']['class'] = sprintf("%s dropup", $view->vars['attr']['class']);
            }
        } elseif ($options['multiselect_enabled']) {
            $view->vars['multiple'] = true;
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = false;
            $view->vars['select2'] = $options['select2'] = false;
            $view->vars['multiselect_enabled'] = true;
            $view->vars['multiselect_search_enabled'] = false;
            $view->vars['attr']['multiple'] = 'multiple';

            if (array_key_exists('class', $view->vars['attr'])) {
                $view->vars['attr']['class'] = sprintf("multiselect %s", $view->vars['attr']['class']);
            }
        } elseif ($options['multiselect_search_enabled']) {
            $view->vars['multiple'] = true;
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = false;
            $view->vars['select2'] = $options['select2'] = false;
            $view->vars['multiselect_enabled'] = false;
            $view->vars['multiselect_search_enabled'] = true;

        } else {
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = false;
            $view->vars['select2'] = $options['select2'] = false;
            $view->vars['multiselect_enabled'] = $options['multiselect_enabled'] = false;
            $view->vars['multiselect_search_enabled'] = $options['multiselect_search_enabled'] = false;
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
        $optionalOptions = array('selectpicker_enabled',
                'selectpicker_data_style',
                'selectpicker_title',
                'selectpicker_selected_text_format',
                'selectpicker_show_tick',
                'selectpicker_data_width',
                'selectpicker_data_size',
                'selectpicker_disabled',
                'selectpicker_dropup',
                'select2',
                'chosen_data_placeholder',
                'chosen_no_results_text',
                'multiselect_enabled',
                'multiselect_search_enabled',
        );

        if (method_exists($resolver, 'setDefined')) {
            $resolver->setDefined($optionalOptions);
        } else {
            // To keep Symfony <2.6 support
            $resolver->setOptional($optionalOptions);
        }

        $resolver->setDefaults(array('select2' => true,
                'selectpicker_enabled' => false,
                'multiselect_enabled' => false,
                'multiselect_search_enabled' => false,
                'error_bubbling'=> true
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'choice';
    }
}
