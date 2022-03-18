<?php

namespace Scpigo\Laravel1cXml\Components\Impls;

use Scpigo\Laravel1cXml\Services\Interfaces\UploadInterface;
use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;
use Scpigo\Laravel1cXml\Services\Interfaces\ReadInterface;

class XmlExchanger implements XmlExchangerInterface {
    private $uploadService;
    private $readService;

    public function __construct(UploadInterface $uploadService, ReadInterface $readService)
    {
        $this->uploadService = $uploadService;
        $this->readService = $readService;
    }

    public function upload(string $path, string $filename) {
        return $this->uploadService->upload($path, $filename);
    }

    public function read(string $path, string $filename) {
        return $this->readService->read($path, $filename);
    }
}