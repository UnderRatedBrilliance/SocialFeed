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

namespace Urb\SocialFeed\Store;


use Facebook\PersistentData\PersistentDataInterface;
use Illuminate\Cache\CacheManager;

class LaravelCachePersistentData implements PersistentDataInterface
{

    protected $cache;

    public function __construct(CacheManager $cache)
    {
        $this->$cache = $cache;
    }

    public function get($key)
    {
       return $this->cache->get($key);
    }

    public function set($key,$value)
    {
        $this->cache->put($key,$value);
    }
}