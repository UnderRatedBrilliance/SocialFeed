<?php
/**
 * Stellaron_${PACKAGE_NAME} extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Stellaron
 * @package        Stellaron_${PACKAGE_NAME}
 * @copyright      Copyright (c) 2017
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @author         georg <george@agenaastro.com>
 */

namespace Urb\SocialFeed\Client;


abstract class AbstractClient implements ClientInterface
{
    protected $config;

    /**
     * AbstractClient constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

}