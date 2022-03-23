<?php

namespace Scpigo\Laravel1cXml\Factories;

use Scpigo\Laravel1cXml\Dto\XmlExchangeConfigDto;
use Scpigo\LaravelCore\Factory\DtoFactory;

class XmlExchangeConfigFactory {
    public static function getExchangerByName(string $name) {
        $exchanger = config('1c.exchangers.'. $name);

        return DtoFactory::dtoOfArray($exchanger, XmlExchangeConfigDto::class);
    }
}