<?php

namespace Scpigo\Laravel1cXml\Components\Impls;

use Scpigo\Laravel1cXml\Services\Interfaces\DownloadInterface;
use Scpigo\Laravel1cXml\Services\Interfaces\UploadInterface;
use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;
use Scpigo\Laravel1cXml\Dto\XmlExchangeConfigDto;
use Scpigo\Laravel1cXml\Services\Interfaces\WriteInterface;
use Scpigo\Laravel1cXml\Services\Interfaces\GenerateInterface;

class XmlExchanger implements XmlExchangerInterface {
    private DownloadInterface $downloadService;
    private UploadInterface $uploadService;
    private WriteInterface $writeService;
    private GenerateInterface $generateService;
    private XmlExchangeConfigDto $config;

    public function __construct(
        DownloadInterface $downloadService, 
        UploadInterface $uploadService,
        WriteInterface $writeService, 
        GenerateInterface $generateService,
        XmlExchangeConfigDto $config)
    {
        $this->downloadService = $downloadService;
        $this->uploadService = $uploadService;
        $this->writeService = $writeService;
        $this->generateService = $generateService;
        $this->config = $config;
    }

    public function download() {
        $this->downloadService->setConfig($this->config);
        return $this->downloadService->download();
    }

    public function upload() {
        $this->uploadService->setConfig($this->config);
        return $this->uploadService->upload();
    }

    public function write() {
        $this->writeService->setConfig($this->config);
        return $this->writeService->write();
    }

    public function generate() {
        $this->generateService->setConfig($this->config);
        return $this->generateService->generate();
    }
}