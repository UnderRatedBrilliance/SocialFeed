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
namespace Urb\SocialFeed\Transformer\Facebook\Post;

use DateTime;
use Urb\SocialFeed\Model\Post as PostModel;
use Urb\SocialFeed\Transformer\Facebook\Post;
use Urb\SocialFeed\Transformer\PostTransformerInterface;

class Status extends Post implements PostTransformerInterface
{

    protected $name = 'FACEBOOK_POST_TYPE_STATUS_TRANSFORMER';

    protected $type = 'facebook_post_status';
    /**
     *
     * @param array|object $data
     * @return PostModel
     */
    public function transform($data)
    {
        if(!$this->validate($data))
        {
            throw new \InvalidArgumentException($this->getName().'- is missing required fields');
        }

        return new PostModel(
            $data['id'], // External Id
            $this->getFeedId($data), //Feed Id
            null, // Title
            $data['message'], // Post Message
            $data['permalink_url'], // Perma Link
            $this->getType($data), // Post Type
            $data, // Meta Info
            $this->getAttachments($data), //Attachments
            new DateTime($data['created_time']),
            new DateTime($data['updated_time'])

        );

    }

    public function getType($data)
    {
        return $this->type;
    }

}