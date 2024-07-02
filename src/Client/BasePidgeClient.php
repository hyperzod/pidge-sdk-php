<?php

namespace Hyperzod\PidgeSdkPhp\Client;

use Exception;
use GuzzleHttp\Client;
use Hyperzod\PidgeSdkPhp\Exception\InvalidArgumentException;

class BasePidgeClient implements PidgeClientInterface
{

   /** @var array<string, mixed> */
   private $config;

   /**
    * Initializes a new instance of the {@link BasePidgeClient} class.
    *
    * The constructor takes two arguments.
    * @param string $username the Username for Pidge's API
    * @param string $password the Password for Pidge's API
    * @param string $api_base the base URL for Pidge's API
    */

   public function __construct($username, $password, $api_base)
   {
      $config = $this->validateConfig(array(
         "username" => $username,
         "password" => $password,
         "api_base" => $api_base
      ));

      $this->config = $config;
   }

   /**
    * Gets the username used by the client to send requests.
    *
    * @return null|string the username used by the client to send requests
    */
   public function getUsername()
   {
      return $this->config['username'];
   }

   /**
    * Gets the password used by the client to send requests.
    *
    * @return null|string the password used by the client to send requests
    */

   public function getPassword()
   {
      return $this->config['password'];
   }

   /**
    * Gets the base URL for Pidge's API.
    *
    * @return string the base URL for Pidge's API
    */
   public function getApiBase()
   {
      return $this->config['api_base'];
   }

   /**
    * Sends a request to Pidge's API.
    *
    * @param string $method the HTTP method
    * @param string $path the path of the request
    * @param array $params the parameters of the request
    */

   public function request($method, $path, $params)
   {
      $client = new Client([
         'headers' => [
            'content-type' => 'application/json',
         ]
      ]);

      $api = $this->getApiBase() . $path;

      $response = $client->request($method, $api, [
         'json' => $params
      ]);

      return $this->validateResponse($response);
   }

   /**
    * @param array<string, mixed> $config
    *
    * @throws InvalidArgumentException
    */
   private function validateConfig($config)
   {
      // username
      if (!isset($config['username'])) {
         throw new InvalidArgumentException('username field is required');
      }

      if (!is_string($config['username'])) {
         throw new InvalidArgumentException('username must be a string');
      }

      if ($config['username'] === '') {
         throw new InvalidArgumentException('username cannot be an empty string');
      }

      if (preg_match('/\s/', $config['username'])) {
         throw new InvalidArgumentException('username cannot contain whitespace');
      }

      // password
      if (!isset($config['password'])) {
         throw new InvalidArgumentException('password field is required');
      }

      if (!is_string($config['password'])) {
         throw new InvalidArgumentException('password must be a string');
      }

      if ($config['password'] === '') {
         throw new InvalidArgumentException('password cannot be an empty string');
      }

      if (!isset($config['api_base'])) {
         throw new InvalidArgumentException('api_base field is required');
      }

      if (!is_string($config['api_base'])) {
         throw new InvalidArgumentException('api_base must be a string');
      }

      if ($config['api_base'] === '') {
         throw new InvalidArgumentException('api_base cannot be an empty string');
      }

      return [
         "username" => $config['username'],
         "password" => $config['password'],
         "api_base" => $config['api_base'],
      ];
   }

   private function validateResponse($response)
   {
      $status_code = $response->getStatusCode();

      if ($status_code >= 200 && $status_code < 300) {
         $response = json_decode($response->getBody(), true);
         return $response;
      } else {
         $response = json_decode($response->getBody(), true);
         if (isset($response["errors"])) {
            throw new Exception($response["errors"][0]["message"]);
         }
         throw new Exception("Errors node not set in server response");
      }
   }
}
