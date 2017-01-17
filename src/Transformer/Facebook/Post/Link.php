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
use Urb\SocialFeed\Model\Attachment;
use Urb\SocialFeed\Model\Post as PostModel;
use Urb\SocialFeed\Transformer\Facebook\Post;
use Urb\SocialFeed\Transformer\PostTransformerInterface;

class Link extends Post implements PostTransformerInterface
{
    /**
     * @var string
     */
    protected $name = 'FACEBOOK_POST_TYPE_LINK_TRANSFORMER';

    /**
     * @var string
     */
    protected $type = 'facebook_post_link';

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
            $data['name'].' | '.$data['caption'], // Title
            $this->getMessage($data), // Post Message
            $this->getLink($data), // Perma Link
            $this->getType($data), // Post Type
            $data, // Meta Info
            $this->getAttachments($data), //Attachments
            new DateTime($data['created_time']),
            new DateTime($data['updated_time'])

        );

    }

    /**
     * @param $data
     * @return string
     */
    protected function getMessage($data)
    {
        $output = '';

        if(isset($data['message']) && $data['message'])
        {
            $output .= $data['message'].PHP_EOL.PHP_EOL;
        }

        if(isset($data['description']) && $data['description'])
        {
            $output .= $data['description'].PHP_EOL.PHP_EOL;
        }

        return $output;
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function getLink($data)
    {
        if(isset($data['link']) && $data['link'])
        {
            return $data['link'];
        }

        return $data['permalink_url'];
    }

    /**
     * @param $data
     * @return string
     */
    protected function getType($data)
    {
        return $this->type;
    }



}