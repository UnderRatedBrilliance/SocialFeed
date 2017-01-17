<?php
/**
 * Urb_SocialFeed
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Urb
 * @package        Urb_SocialFeed
 * @copyright      Copyright (c) 2017
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @author         george <george@underratedbrilliance.com>
 */

namespace Urb\SocialFeed\Client;


use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Urb\SocialFeed\Client\ClientInterface;
use Urb\SocialFeed\Client\AbstractClient;

class FacebookApiClient extends AbstractClient implements ClientInterface
{
    protected $facebook;

    /**
     * FacebookApiClient constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {

        $this->validateConfig($config);
        $this->config = $this->applyConfigDefaults($config);
        $this->facebook = new Facebook($this->config);
    }

    /**
     * Validate Config Array
     *
     * @param array $config
     * @throws FacebookSDKException
     */
    protected function validateConfig(array $config)
    {
        if(!isset($config['app_id']))
        {
            throw new FacebookSDKException('Required "app_id" key not supplied in config ');
        }

        if(!isset($config['app_secret']))
        {
            throw new FacebookSDKException('Required "app_secret" key not supplied in config');
        }
    }

    /**
     * Apply Facebook Config Defaults
     *
     * @param array $config
     * @return array
     */
    protected function applyConfigDefaults(array $config)
    {
        //If no access token is set generate and apply facebook client token
        if(!isset($config['default_access_token']))
        {
            $config['default_access_token'] = $config['app_id'].'|'.$config['app_secret'];
        }
        return $config;
    }

    /**
     * @param array $config
     * @return \Facebook\FacebookResponse
     */
    public function getData(array $config)
    {
        return $this->facebook->get($config['endpoint']);
    }
}