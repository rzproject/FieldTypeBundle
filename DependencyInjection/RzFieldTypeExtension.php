<?php

namespace Rz\FieldTypeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RzFieldTypeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('form_type.xml');
        $loader->load('twig.xml');
        $this->registerService($config, $container);
    }

    protected function registerService(array $config, ContainerBuilder $container) {

        $container->setParameter('twig.form.resources',
                                 array_merge($container->getParameter('twig.form.resources'),
                                             array('RzFieldTypeBundle::fields.html.twig')
                                 )
        );
    }
}
