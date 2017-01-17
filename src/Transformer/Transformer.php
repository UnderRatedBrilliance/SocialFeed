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
namespace Urb\SocialFeed\Transformer;

use Urb\SocialFeed\Model\Post;

abstract class Transformer implements PostTransformerInterface
{
    protected $name;

    protected $feed_id;

    protected $required = [];

    /**
     *
     * @param array|object $data
     * @return Post
     */
    abstract public function transform($data);



    /**
     * Return Transformer Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validate($data)
    {
        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    protected function hasRequiredFields($data)
    {
        return array_has($data,$this->required);
    }

}