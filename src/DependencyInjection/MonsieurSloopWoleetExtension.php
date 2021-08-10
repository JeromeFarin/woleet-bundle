<?php

namespace MonsieurSloop\Bundle\WoleetBundle\DependencyInjection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

class MonsieurSloopWoleetExtension extends Extension
{

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        //var_dump("Monsieur SLOOP Woleet© Bundle Here !!!");
        //dump($configs, $container);

        $configuration = new Configuration();


        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $container->setParameter(Configuration::$ROOTNODE, $config);
        $container->setParameter("monsieur_sloop_woleet.api_token", $config["api_token"]);
        $container->setParameter("monsieur_sloop_woleet.callback_secret", $config["callback_secret"]);
        $container->setParameter("monsieur_sloop_woleet.api_url", $config["api_url"]);


    }
}
