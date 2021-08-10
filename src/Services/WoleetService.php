<?php

namespace MonsieurSloop\Bundle\WoleetBundle\Services;

use MonsieurSloop\Woleet\WoleetClient;
use Symfony\Component\HttpFoundation\Request;
use WooletClient\Api\AnchorApi;
use WooletClient\Api\DomainApi;
use WooletClient\Api\ReceiptApi;
use WooletClient\Api\SignatureRequestApi;
use WooletClient\Api\TokenApi;
use WooletClient\Api\UserApi;
use WooletClient\Configuration;

class WoleetService
{


    private $api_token;
    private $callback_secret;
    private $api_url;

    /**
     * @var Configuration
     */
    private $config;

    public function __construct($api_token, $callback_secret, $api_url)
    {

        $this->api_token = $api_token;
        $this->callback_secret = $callback_secret;
        $this->api_url = $api_url;
        $this->config = Configuration::getDefaultConfiguration()
            ->setApiKey('Authorization', 'Bearer ' . $this->api_token)
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


    /**
     * Used to check the secret callback key system.
     * @param Request $request
     * @return bool|null
     */
    public function checkCallBack(Request $request) : ?bool{
        $body = $request->getContent();
        $callBHash = $request->headers->get("X-Woleet-Signature");
        $myHash = base64_encode(hash_hmac("sha1", $body, $this->callback_secret, true));
        return $callBHash === $myHash;
    }

    /**
     * Decode the callback body if the callback hash is checked
     * @param $request
     * @return object|null
     */
    public function decodeCallback(Request $request) : ?object{
        if(!$this->checkCallBack($request)){
            return null;
        } else {
            try {
                $body = json_decode($request->getContent());
            } catch (\Exception $e){
                return null;
            }
            return $body;
        }
    }

}
