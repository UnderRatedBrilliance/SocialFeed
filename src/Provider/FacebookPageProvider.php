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


use Facebook\Url\FacebookUrlManipulator;
use Urb\SocialFeed\Client\ClientInterface;
use Urb\SocialFeed\Client\FacebookApiClient;
use Facebook\Exceptions\FacebookOtherException;
use Urb\SocialFeed\Transformer\PostTransformerInterface;

class FacebookPageProvider extends Provider
{
   const FACEBOOK_PAGE_POSTS_ENDPOINT = '{{page_id}}/posts';

   const PROVIDER_ID = 'facebook_{{page_id}}_posts';

   protected $fields = [
       /** Post Fields */
       'id',
       'caption',
       'description',
       'link',
       'message',
       'name',
       'from',
       'permalink_url',
       'picture',
       'type', // possible values {link,status, photo, video, offer}
       'created_time',
       'updated_time',

       /** Facebook Edges */
       'attachments',
   ];

    /**
     * FacebookPageProvider constructor.
     *
     * @param ClientInterface $client
     * @param PostTransformerInterface $transformer
     * @param array $config
     */
   public function __construct(ClientInterface $client, PostTransformerInterface $transformer, array $config)
   {
       $this->validateConfig($config);
       /** @var $client FacebookApiClient */
       parent::__construct($client,$transformer, $config);
   }

    /**
     * Validate configuration
     *
     * @param array $config
     * @throws FacebookOtherException
     */
   protected function validateConfig(array $config)
   {
       if(!isset($config['page_id']))
       {
           throw new FacebookOtherException('Required "page_id" key not supplied in config ');
       }
   }

    /**
     * @return mixed
     */
   public function getPosts()
   {
      return $this->getData();
   }

    /**
     * @return mixed
     */
   protected function getData()
   {
       $config = [
           'endpoint' => $this->generateUrl(
               str_replace('{{page_id}}',$this->config['page_id'],self::FACEBOOK_PAGE_POSTS_ENDPOINT),
               $this->generateParams()
           )
       ];

       return $this->client->getData($config);
   }

    /**
     * Gets unique Provider Id for a particular facebook page
     *
     * @return string
     */
    public function getProviderID()
    {
        return str_replace('{{page_id}}',$this->config['page_id'],self::PROVIDER_ID);
    }

    /**
     * Generate Endpoint Parameters
     *
     * @param array $params
     * @return array
     */
   protected function generateParams(array $params = [])
   {
       return array_merge([
           'limit' => 10,
           'since' => null,
           'until' => null,
           'fields' => implode(',',$this->fields),
       ], $params);
   }

    /**
     * Generate Endpoint URL with parameters
     *
     * @param $url
     * @param array $params
     * @return string
     */
   protected function generateUrl($url,array $params = [])
   {
      return FacebookUrlManipulator::appendParamsToUrl($url, $params);
   }
}