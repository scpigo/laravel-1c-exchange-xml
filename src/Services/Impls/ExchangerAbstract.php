<?php

namespace Scpigo\Laravel1cXml\Services\Impls;

abstract class ExchangerAbstract {
    protected $config;

    public function setConfig($config) {
        $this->config = $config;
    }
}