<?php

namespace Hyperzod\PidgeSdkPhp\Client;

use Hyperzod\PidgeSdkPhp\Service\CoreServiceFactory;

class PidgeClient extends BasePidgeClient
{
    /**
     * @var CoreServiceFactory
     */
    private $coreServiceFactory;

    public function __get($name)
    {
        if (null === $this->coreServiceFactory) {
            $this->coreServiceFactory = new CoreServiceFactory($this);
        }

        return $this->coreServiceFactory->__get($name);
    }
}
