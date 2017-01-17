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

namespace Urb\SocialFeed\Provider;

use Urb\SocialFeed\Provider\ProviderInterface;
use Urb\SocialFeed\Transformer\PostTransformerInterface;
use Urb\SocialFeed\Client\ClientInterface;

abstract class Provider implements ProviderInterface
{
    CONST PROVIDER_ID = 'ABSTRACT_PROVIDER';

    protected $client;

    protected $config;

    protected $transformer;

    public function __construct(ClientInterface $client, PostTransformerInterface $transformer, array $config = [])
    {
        $this->client      = $client;
        $this->config      = $config;
        $this->transformer = $transformer;
    }

    abstract public function getPosts();

    /**
     * Returns Provider Unique Id
     *
     * should be a unique id generated for each particular feed provider
     *
     * @return string
     */
    public function getProviderID()
    {
        return self::PROVIDER_ID;
    }

}