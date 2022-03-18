<?php

namespace Scpigo\Laravel1cXml\Helpers;

use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;

class XmlExchangeManager {
    public function exchanger($name = null) {
        if (is_null($name)) $name = config('1c.default');

        return app()->makeWith(XmlExchangerInterface::class, [
            'uploadService' => app()->make(config('1c.exchangers.'. $name .'.server_disk_driver')),
            'readService' => app()->make(config('1c.exchangers.'. $name .'.db_driver')),
            'exchanger' => $name
        ]);
    }
}