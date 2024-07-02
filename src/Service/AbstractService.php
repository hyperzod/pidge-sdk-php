<?php

namespace Hyperzod\PidgeSdkPhp\Service;

/**
 * Abstract base class for all services.
 */
abstract class AbstractService
{
   /**
    * @var \Hyperzod\PidgeSdkPhp\Client\PidgeClientInterface
    */
   protected $client;

   /**
    * Initializes a new instance of the {@link AbstractService} class.
    *
    * @param \Hyperzod\PidgeSdkPhp\Client\PidgeClientInterface $client
    */
   public function __construct($client)
   {
      $this->client = $client;
   }

   /**
    * Gets the client used by this service to send requests.
    *
    * @return \Hyperzod\PidgeSdkPhp\Client\PidgeClientInterface
    */
   public function getClient()
   {
      return $this->client;
   }

   protected function request($method, $path, $params)
   {
      return $this->getClient()->request($method, $path, $params);
   }
}
