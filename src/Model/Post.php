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

namespace Urb\SocialFeed\Model;


use DateTime;

class Post implements PostInterface
{

    /** @var  string */
    protected $external_id;

    /** @var string */
    protected $feed_id;

    /** @var  string */
    protected $title;

    /** @var  string */
    protected $message;

    /** @var  string */
    protected $link;

    /** @var  string */
    protected $type;

    /** @var  array (json|array) */
    protected $metaInfo;

    /** @var  array */
    protected $attachments;

    /** @var  DateTime */
    protected $created_at;

    /** @var  DateTime */
    protected $updated_at;

    /**
     * Post constructor.
     *
     * @param string $external_id
     * @param integer $feed_id
     * @param string $title
     * @param string $message
     * @param string $link
     * @param string $type
     * @param array $metaInfo
     * @param array $attachments
     * @param DateTime $created_at
     * @param DateTime $updated_at
     */
    public function __construct($external_id, $feed_id, $title, $message, $link, $type, array $metaInfo = [], array $attachments = [], DateTime $created_at, DateTime $updated_at)
    {
        $this->external_id = $external_id;
        $this->feed_id     = $feed_id;
        $this->title       = $title;
        $this->message     = $message;
        $this->link        = $link;
        $this->type        = $type;
        $this->metaInfo    = $metaInfo;
        $this->attachments = $attachments;
        $this->created_at  = $created_at;
        $this->updated_at  = $updated_at;
    }


    /**
     * Get Unique Post Hash
     *
     * @return string MD5 hash
     */
    public function getPostHash()
    {
        return md5($this->feed_id.'_'.$this->external_id);
    }


    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * @param string $external_id
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getMetaInfo()
    {
        return $this->metaInfo;
    }

    /**
     * @param array $metaInfo
     */
    public function setMetaInfo(array $metaInfo)
    {
        $this->metaInfo = $metaInfo;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     */
    public function setAttachments(array $attachments)
    {
        $this->attachments = $attachments;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Return Post Model to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * @return string
     */
    public function getFeedId()
    {
        return $this->feed_id;
    }

    /**
     * @param string $feed_id
     */
    public function setFeedId($feed_id)
    {
        $this->feed_id = $feed_id;
    }

    /**
     * Return Post Model as JSON
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {

        return [
            'post_hash'   => $this->getPostHash(),
            'external_id' => $this->getExternalId(),
            'feed_id'     => $this->getFeedId(),
            'title'       => $this->getTitle(),
            'message'     => $this->getMessage(),
            'link'        => $this->getLink(),
            'type'        => $this->getType(),
            'meta_info'   => $this->getMetaInfo(),
            'attachments' => array_map(
                function($value)
                {
                    return $value->toArray();
                },$this->getAttachments()),
            'created_at'  => $this->getCreatedAt(),
            'updated_at'  => $this->getUpdatedAt(),
        ];
    }

}