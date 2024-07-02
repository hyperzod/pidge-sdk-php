<?php

namespace Hyperzod\PidgeSdkPhp\Service;

use Hyperzod\PidgeSdkPhp\Enums\HttpMethodEnum;

class LoginService extends AbstractService
{
   /**
    * Create a job on Pidge
    *
    * @param array $params
    *
    * @throws \Hyperzod\PidgeSdkPhp\Exception\ApiErrorException if the request fails
    *
    */
   public function create(array $params)
   {
      return $this->request(HttpMethodEnum::POST, '/login', $params);
   }
}
