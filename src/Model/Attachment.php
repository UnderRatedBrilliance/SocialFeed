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

class Attachment
{


    /** @var  string */
    protected $type;

    /** @var  string */
    protected $name;

    /** @var  string */
    protected $url;

    /** @var  string */
    protected $description;

    /** @var  array */
    protected $metaInfo;

    /** @var  DateTime */
    protected $created_at;

    /** @var  DateTime */
    protected $updated_at;

    /**
     * Attachment constructor.
     *
     * @param string $type
     * @param string $name
     * @param string $url
     * @param string $description
     * @param array $metaInfo
     * @param DateTime $created_at
     * @param DateTime $updated_at
     */
    public function __construct($type, $name, $url, $description, array $metaInfo, DateTime $created_at, DateTime $updated_at)
    {
        $this->type        = $type;
        $this->name        = $name;
        $this->url         = $url;
        $this->description = $description;
        $this->metaInfo    = $metaInfo;
        $this->created_at  = $created_at;
        $this->updated_at  = $updated_at;
    }

    public function getAttachmentHash()
    {
        return md5($this->getType().'_'.$this->getName().'_'.$this->getUrl());
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Return Attachment toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Return Attachment as Json
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
            'attachment_hash'  => $this->getAttachmentHash(),
            'type'             => $this->getType(),
            'name'             => $this->getName(),
            'url'              => $this->getUrl(),
            'description'      => $this->getDescription(),
            'meta_info'        => $this->getMetaInfo(),
            'created_at'       => $this->getCreatedAt(),
            'updated_at'       => $this->getUpdatedAt(),
        ];
    }
}