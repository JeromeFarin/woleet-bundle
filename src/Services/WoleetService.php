<?php

namespace MonsieurSloop\Bundle\WoleetBundle\Services;

use MonsieurSloop\Woleet\WoleetClient;
use WooletClient\Api\AnchorApi;
use WooletClient\Api\DomainApi;
use WooletClient\Api\ReceiptApi;
use WooletClient\Api\SignatureRequestApi;
use WooletClient\Api\TokenApi;
use WooletClient\Api\UserApi;
use WooletClient\Configuration;

class WoleetService
{


    private $api_key;
    private $api_callback_key;
    private $api_url;

    /**
     * @var Configuration
     */
    private $config;

    public function __construct($api_key, $api_callback_key, $api_url)
    {

        $this->api_key = $api_key;
        $this->api_callback_key = $api_callback_key;
        $this->api_url = $api_url;
        $this->config = Configuration::getDefaultConfiguration()
            ->setApiKey('Authorization', 'Bearer ' . $this->api_key)
            ->setHost($this->api_url);

    }

    /**
     * @return AnchorApi
     */
    public function getAnchorApi($client = null, $selector = null)
    {
        return new AnchorApi($client, $this->config, $selector);
    }

    /**
     * @return DomainApi
     */
    public function getDomainApi($client = null, $selector = null)
    {
        return new DomainApi($client, $this->config, $selector);
    }


    /**
     * @return ReceiptApi
     */
    public function getReceiptApi($client = null, $selector = null)
    {
        return new ReceiptApi($client, $this->config, $selector);
    }

    /**
     * @return SignatureRequestApi
     */
    public function getSignatureRequestApi($client = null, $selector = null)
    {
        return new SignatureRequestApi($client, $this->config, $selector);
    }

    /**
     * @return TokenApi
     */
    public function getTokenApi($client = null, $selector = null)
    {
        return new TokenApi($client, $this->config, $selector);
    }

    /**
     * @return UserApi
     */
    public function getUserApi($client = null, $selector = null)
    {
        return new UserApi($client, $this->config, $selector);
    }

}
