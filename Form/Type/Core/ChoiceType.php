<?php
namespace Rz\FieldTypeBundle\Form\Type\Core;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToLocalizedStringTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\ChoiceToValueTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\ChoicesToValuesTransformer;
use Rz\FieldTypeBundle\Form\DataTransformer\ChoicesToArrayTransformer;


class ChoiceType extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        //parent::buildView($view, $form, $options);
        //* TODO: enable via config
        if($options['expanded']) {
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled']= false;
            $view->vars['chosen_enabled'] = $options['chosen_enabled'] =  false;
            $view->vars['multiselect_enabled'] = $options['multiselect_enabled'] = false;
            $view->vars['multiselect_search_enabled'] = $options['multiselect_search_enabled'] = false;
        } elseif ($options['chosen_enabled']) {
                $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled']= false;
                $view->vars['chosen_enabled'] = $options['chosen_enabled'] =  true;
                $view->vars['multiselect_enabled'] = $options['multiselect_enabled'] = false;
                $view->vars['multiselect_search_enabled'] = $options['multiselect_search_enabled'] = false;

                $view->vars['attr']['class'] = sprintf(($options['multiple']) ? "chzn-select-multiple %s" : "chzn-select %s", $view->vars['attr']['class']);
                $view->vars['attr']['chosen_data_placeholder'] = array_key_exists('chosen_data_placeholder', $options) ? $options['chosen_data_placeholder'] : 'Choose one of the following...';
                $view->vars['attr']['chosen_no_results_text'] = array_key_exists('chosen_no_results_text', $options) ? $options['chosen_no_results_text'] : 'No record found.';

        } elseif($options['selectpicker_enabled']) {
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = true;
            $view->vars['chosen_enabled'] = $options['chosen_enabled'] = false;
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
            //$view->vars['selectpicker_selected_text_format'] = array_key_exists('selectpicker_selected_text_format', $options) ? $options['selectpicker_selected_text_format'] : 'values';

            $view->vars['attr']['data-size'] = array_key_exists('selectpicker_data_size', $options) ? $options['selectpicker_data_size'] : '5';


            if (array_key_exists('selectpicker_data_width', $options)) {
                $view->vars['attr']['data-width'] = $options['selectpicker_data_width'];
            }

            if (array_key_exists('selectpicker_disabled', $options)) {
                $view->vars['attr']['disabled'] = $options['selectpicker_disabled'];
            }

            if (array_key_exists('selectpicker_dropup', $options)) {
                $view->vars['attr']['class'] = sprintf("%s dropup", $view->vars['attr']['class']);
            }
        } elseif($options['multiselect_enabled']) {
            $view->vars['multiple'] = true;
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = false;
            $view->vars['chosen_enabled'] = $options['chosen_enabled'] = false;
            $view->vars['multiselect_enabled'] = true;
            $view->vars['multiselect_search_enabled'] = false;

            if (array_key_exists('class', $view->vars['attr'])) {
                $view->vars['attr']['class'] = sprintf("multiselect %s", $view->vars['attr']['class']);
            }
        } elseif($options['multiselect_search_enabled']) {
            $view->vars['multiple'] = true;
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = false;
            $view->vars['chosen_enabled'] = $options['chosen_enabled'] = false;
            $view->vars['multiselect_enabled'] = false;
            $view->vars['multiselect_search_enabled'] = true;

        } else {
            $view->vars['selectpicker_enabled'] = $options['selectpicker_enabled'] = false;
            $view->vars['chosen_enabled'] = $options['chosen_enabled'] = false;
            $view->vars['multiselect_enabled'] = $options['multiselect_enabled'] = false;
            $view->vars['multiselect_search_enabled'] = $options['multiselect_search_enabled'] = false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('selectpicker_enabled',
                                     'selectpicker_data_style',
                                     'selectpicker_title',
                                     'selectpicker_selected_text_format',
                                     'selectpicker_show_tick',
                                     'selectpicker_data_width',
                                     'selectpicker_data_size',
                                     'selectpicker_disabled',
                                     'selectpicker_dropup',
                                     'chosen_enabled',
                                     'chosen_data_placeholder',
                                     'chosen_no_results_text',
                                     'multiselect_enabled',
                                     'multiselect_search_enabled',
                                    )
                              );
        $resolver->setDefaults(array('chosen_enabled' => false,
                                     'selectpicker_enabled' => true,
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
