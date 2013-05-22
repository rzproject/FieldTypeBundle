<?php

namespace Rz\FieldTypeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerInterface;


class OverrideCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        //override TextBlockService
        $admin_pool = $container->getDefinition('sonata.admin.pool');
        $admin_pool->addMethodCall('setTemplates', array($container->getParameter('rz_admin.configuration.templates')));
    }
}
