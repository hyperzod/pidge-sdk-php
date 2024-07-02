<?php

namespace Hyperzod\PidgeSdkPhp\Service;

use Hyperzod\PidgeSdkPhp\Enums\HttpMethodEnum;

class OrderService extends AbstractService
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
      return $this->request(HttpMethodEnum::POST, '/order', $params);
   }

   /**
    * Get a job on Pidge
    *
    * @param array $params
    *
    * @throws \Hyperzod\PidgeSdkPhp\Exception\ApiErrorException if the request fails
    *
    */

   public function get(array $params)
   {
      return $this->request(HttpMethodEnum::GET, '/order/' . $params['order_id'], $params);
   }
}
