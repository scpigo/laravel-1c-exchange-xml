<?php

namespace Scpigo\Laravel1cXml\Components\Impls;

use Scpigo\Laravel1cXml\Services\Interfaces\UploadInterface;
use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;
use Scpigo\Laravel1cXml\Services\Interfaces\ReadInterface;

class XmlExchanger implements XmlExchangerInterface {
    private UploadInterface $uploadService;
    private ReadInterface $readService;
    private string $exchanger;

    public function __construct(UploadInterface $uploadService, ReadInterface $readService, string $exchanger)
    {
        $this->uploadService = $uploadService;
        $this->readService = $readService;
        $this->exchanger = $exchanger;
    }

    public function upload() {
        return $this->uploadService->upload(
            config('1c.exchangers.'. $this->exchanger .'.local_disk_driver'),
            config('1c.exchangers.'. $this->exchanger .'.local_path'),
            config('1c.exchangers.'. $this->exchanger .'.server_path'),
            config('1c.exchangers.'. $this->exchanger .'.filename')
        );
    }

    public function read() {
        return $this->readService->read(
            config('1c.exchangers.'. $this->exchanger .'.local_disk_driver'),
            config('1c.exchangers.'. $this->exchanger .'.local_path'),
            config('1c.exchangers.'. $this->exchanger .'.filename')
        );
    }
}