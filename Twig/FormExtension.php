<?php

namespace Rz\FieldTypeBundle\Twig;

class FormExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'rz_get_span_class' => new \Twig_SimpleFilter('rz_get_span_class', array($this, 'getSpanClass')),
        );
    }

    public function getFunctions()
    {
        return array(
            'rz_replace_span_class' => new \Twig_SimpleFunction('rz_replace_span_class', array($this, 'replaceSpanClass')),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getSpanClass(array $value)
    {

        $temp = array_key_exists('class', $value) ?  $value['class'] : null;
        if ($temp) {
            $aValue = explode(" ", $temp);
            foreach ($aValue as $val) {
                if (!strstr($val, 'span')) {
                    continue;
                } else {
                    return $val;
                }
            }
        }

        return;
    }

    public function replaceSpanClass(array $value)
    {
        $temp = array_key_exists('class', $value) ?  $value['class'] : null;
       if ($temp) {
           $aValue = explode(" ", $temp);
           $aVal = array();
           foreach ($aValue as $val) {
               if (!strstr($val, 'span')) {
                   array_push($aVal, $val);
               } else {
                   array_push($aVal, 'span12');
               }
           }

           return implode(' ', $aVal);
       }

       return $temp;
    }

    public function getName()
    {
        return 'rz_form_extension';
    }
}
