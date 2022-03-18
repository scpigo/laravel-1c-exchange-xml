<?php

namespace Scpigo\Laravel1cXml\Components\Interfaces;

interface XmlExchangerInterface {
    public function upload(string $path, string $filename);
    public function read(string $path, string $filename);
}