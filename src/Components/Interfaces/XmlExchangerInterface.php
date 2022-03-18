<?php

namespace Scpigo\Laravel1cXml\Components\Interfaces;

interface XmlExchangerInterface {
    public function download();
    public function upload();
    public function write();
}