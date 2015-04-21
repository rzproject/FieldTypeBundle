<?php


namespace Rz\FieldTypeBundle\Form\Type\Custom;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GoogleMapType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add($options['lat_name'], $options['type'], array_merge($options['options'], $options['lat_options']))
            ->add($options['lng_name'], $options['type'], array_merge($options['options'], $options['lng_options']))
        ;
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
        $resolver->setDefaults(array(
            'type'           => 'hidden',  // the types to render the lat and lng fields as
            'options'        => array(), // the options for both the fields
            'lat_options'  => array(),   // the options for just the lat field
            'lng_options' => array(),    // the options for just the lng field
            'lat_name'       => 'lat',   // the name of the lat field
            'lng_name'       => 'lng',   // the name of the lng field
            'error_bubbling' => false,
            'map_width'      => 254,     // the width of the map
            'map_height'     => 254,     // the height of the map
            'default_lat'    => 51.5,    // the starting position on the map
            'default_lng'    => -0.1245, // the starting position on the map
            'include_gmaps_js'=>true     // is this the best place to include the google maps javascript?
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['lat_name'] = $options['lat_name'];
        $view->vars['lng_name'] = $options['lng_name'];
        $view->vars['map_width'] = $options['map_width'];
        $view->vars['map_height'] = $options['map_height'];
        $view->vars['default_lat'] = $options['default_lat'];
        $view->vars['default_lng'] = $options['default_lng'];
        $view->vars['include_gmaps_js'] = $options['include_gmaps_js'];
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'rz_google_maps';
    }
}