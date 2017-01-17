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

namespace Urb\SocialFeed\Transformer\Facebook;

use DateTime;
use InvalidArgumentException;
use Urb\SocialFeed\Model\Post as PostModel;
use Urb\SocialFeed\Transformer\Facebook\Post\Link;
use Urb\SocialFeed\Transformer\Facebook\Post\Offer;
use Urb\SocialFeed\Transformer\Facebook\Post\Photo;
use Urb\SocialFeed\Transformer\Facebook\Post\Status;
use Urb\SocialFeed\Transformer\Facebook\Post\Video;
use Urb\SocialFeed\Transformer\Transformer;
use Urb\SocialFeed\Transformer\PostTransformerInterface;
use Urb\SocialFeed\Model\Attachment;

class Post extends Transformer implements PostTransformerInterface
{
    CONST FACEBOOK_POST_TYPE_LINK   = 'link';
    CONST FACEBOOK_POST_TYPE_STATUS = 'status';
    CONST FACEBOOK_POST_TYPE_PHOTO  = 'photo';
    CONST FACEBOOK_POST_TYPE_VIDEO  = 'video';
    CONST FACEBOOK_POST_TYPE_OFFER  = 'offer';

    protected $name = 'FACEBOOK_POST_TRANSFORMER';

    protected $required = [
        'id',
        'permalink_url',
        'type',
        'created_time',
        'updated_time',
        'from',
    ];

    /**
     *
     * @param array|object $data
     * @return PostModel
     */
    public function transform($data)
    {
        if(!$this->validate($data))
        {
            throw new InvalidArgumentException($this->getName().'- is missing required fields');
        }

        /**
         * Transformer Switch based on Page Post Type
         */
        switch($this->getType($data))
        {
            case self::FACEBOOK_POST_TYPE_LINK:
                return (new Link)->transform($data);
            case self::FACEBOOK_POST_TYPE_PHOTO:
                return (new Photo)->transform($data);
            case self::FACEBOOK_POST_TYPE_STATUS:
                return (new Status)->transform($data);
            case self::FACEBOOK_POST_TYPE_VIDEO:
                return (new Video)->transform($data);
            case self::FACEBOOK_POST_TYPE_OFFER:
                return (new Offer)->transform($data);
            default:
                throw new InvalidArgumentException($this->getType($data).'- is an invalid type for '.$this->getName());
        }

    }


    /**
     * Return Data Type
     *
     * @param $data
     * @return mixed
     */
    protected function getType($data)
    {
        return $data['type'];
    }

    public function getFeedId($data)
    {
        return crc32('FACEBOOK_'.$data['from']['name']);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validate($data)
    {
        if(!$this->hasRequiredFields($data))
        {
            return false;
        }

        return true;
    }


    protected function getAttachments($data)
    {
        $attachments = [];

        if(!isset($data['attachments']))
        {
            return $attachments;
        }

        foreach($data['attachments']['data'] as $attachment)
        {
            if(!isset($attachment['media']))
            {
              continue;
            }

            $attachments[] = new Attachment(
                'image', //attachment type
                $attachment['title'], //attachment name
                $attachment['media']['image']['src'], //url
                $attachment['description'], // Description
                $attachment, // Meta info
                new DateTime($data['created_time']), //Created at
                new DateTime($data['updated_time']) //updated At

            );
        }

        return $attachments;
    }

}