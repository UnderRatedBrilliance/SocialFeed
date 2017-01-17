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

interface PostTransformerInterface
{

    /**
     * Transform Input Data into Post Model
     *
     * @param $data array|object
     * @return Post
     */
    public function transform($data);

    /**
     * Validate Data
     *
     * @param $data
     * @return bool
     */
    public function validate($data);

    /**
     * Get Transformer Name
     *
     * @return string
     */
    public function getName();
}