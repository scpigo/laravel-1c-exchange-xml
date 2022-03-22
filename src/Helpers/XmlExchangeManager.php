<?php

namespace Scpigo\Laravel1cXml\Helpers;

use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;
use Scpigo\Laravel1cXml\Factories\XmlExchangeConfigFactory;

class XmlExchangeManager {
    public function exchanger($name = null) {
        if (is_null($name)) $name = config('1c.default');

        $config = XmlExchangeConfigFactory::getExchangerByName($name);

        return app()->makeWith(XmlExchangerInterface::class, [
            'downloadService' => app()->make('download_'. $config->server_disk_driver),
            'uploadService' => app()->make('upload_'. $config->server_disk_driver),
            'writeService' => app()->make('write_'. $config->db_driver),
            'generateService' => app()->make('generate_'. $config->db_driver),
            'config' => $config
        ]);
    }
}