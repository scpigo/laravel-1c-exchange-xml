<?php

namespace Scpigo\Laravel1cXml\Components\Impls;

use Scpigo\Laravel1cXml\Services\Interfaces\DownloadInterface;
use Scpigo\Laravel1cXml\Services\Interfaces\UploadInterface;
use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;
use Scpigo\Laravel1cXml\Services\Interfaces\WriteInterface;

class XmlExchanger implements XmlExchangerInterface {
    private DownloadInterface $downloadService;
    private UploadInterface $uploadService;
    private WriteInterface $writeService;
    private string $exchanger;

    public function __construct(
        DownloadInterface $downloadService, 
        UploadInterface $uploadService,
        WriteInterface $writeService, 
        string $exchanger)
    {
        $this->downloadService = $downloadService;
        $this->uploadService = $uploadService;
        $this->writeService = $writeService;
        $this->exchanger = $exchanger;
    }

    public function download() {
        return $this->downloadService->download(
            config('1c.exchangers.'. $this->exchanger .'.local_disk_driver'),
            config('1c.exchangers.'. $this->exchanger .'.local_path'),
            config('1c.exchangers.'. $this->exchanger .'.server_path'),
            config('1c.exchangers.'. $this->exchanger .'.filename')
        );
    }

    public function upload() {
        return $this->uploadService->upload(
            config('1c.exchangers.'. $this->exchanger .'.local_disk_driver'),
            config('1c.exchangers.'. $this->exchanger .'.local_path'),
            config('1c.exchangers.'. $this->exchanger .'.server_path'),
            config('1c.exchangers.'. $this->exchanger .'.filename')
        );
    }

    public function write() {
        return $this->writeService->write(
            config('1c.exchangers.'. $this->exchanger .'.local_disk_driver'),
            config('1c.exchangers.'. $this->exchanger .'.local_path'),
            config('1c.exchangers.'. $this->exchanger .'.filename')
        );
    }
}