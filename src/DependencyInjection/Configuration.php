<?php

namespace MonsieurSloop\Bundle\WoleetBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public static $ROOTNODE = "monsieur_sloop_woleet";

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(self::$ROOTNODE);
        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root(self::$ROOTNODE);
        }
        $rootNode->children()
            ->scalarNode('api_token')
            ->info('The Woleet API TOKEN. This is a secret part generated from the Woleet Proofdesk.')
            ->isRequired()
            ->end()
            ->scalarNode('callback_secret')
            ->info('The Woleet CALLBACK SECRET. This is a secret part generated from the Woleet Proofdesk.')
            ->end()
            ->scalarNode('api_url')
            ->defaultValue('https://api.woleet.io/v1')
            ->info('The Woleet API URL, It may be a custom domain.')
            ->end();
        return $treeBuilder;
    }
}
