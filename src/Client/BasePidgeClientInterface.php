<?php

namespace Hyperzod\PidgeSdkPhp\Client;

/**
 * Interface for a Pidge client.
 */
interface BasePidgeClientInterface
{
   /**
    * Gets the username used by the client to send requests.
    *
    * @return null|string the username used by the client to send requests
    */
   public function getUsername();

   /**
    * Gets the password used by the client to send requests.
    *
    * @return null|string the password used by the client to send requests
    */
   public function getPassword();

   /**
    * Gets the base URL for Pidge's API.
    *
    * @return string the base URL for Pidge's API
    */
   public function getApiBase();
}
