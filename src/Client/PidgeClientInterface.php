<?php

namespace Hyperzod\PidgeSdkPhp\Client;

/**
 * Interface for a Pidge client.
 */
interface PidgeClientInterface extends BasePidgeClientInterface
{
   /**
    * Sends a request to Pidge's API.
    *
    * @param string $method the HTTP method
    * @param string $path the path of the request
    * @param array $params the parameters of the request
    */
   public function request($method, $path, $params);
}
